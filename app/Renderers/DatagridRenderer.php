<?php

namespace App\Renderers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DatagridRenderer
{
    /**
     * Columns
     * @var array
     */
    protected $columns = [];

    /**
     * Data
     * @var array
     */
    protected $data = [];

    /**
     * Options
     * @var array
     */
    protected $options = [];

    /**
     * User
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    protected $user;


    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * @param array $columns
     * @param array $data
     * @param array $options
     */
    public function render(
        $columns = [],
        $data = [],
        $options = []
    ) {
        $this->columns = $columns;
        $this->data = $data;
        $this->options = $options;

        $html = '<table id="' . $this->getOption('baseRoute') . '" class="table table-striped">';
        $html .= '<thead><tr>';
        $html .= $this->renderColumns();
        $html .=  '</tr></thead>';
        $html .=  '<tbody>';
        $html .= $this->renderRows();
        $html .=  '</tbody></table>';

        return $html;
    }

    /**
     *
     */
    private function renderColumns()
    {
        $html = '';
        foreach ($this->columns as $column) {
            $html .= $this->renderHeadColumn($column);
        }
        // Admin column

        $html .= '<th><br /></th>';
        return $html;
    }

    /**
     * @param $column
     */
    private function renderHeadColumn($column)
    {
        $html = null;
        $class = null;

        // Easy mode: A string. We want to return it directly since it's so easy.
        if (is_string($column)) {
            return "<th>" . $this->route($column) . "</th>\n";
        }

        // Check visibility
        if (isset($column['visible']) && $column['visible'] == false) {
            return null;
        }

        if (!empty($column['type'])) {
            // We have a type so we know what to do
            $type = $column['type'];
            $class = $column['type'];
            if ($type == 'avatar') {
                $html = null;
            } elseif ($type == 'location') {
                $html = trans('crud.fields.location');
            } elseif ($type == 'character') {
                $html = trans('crud.fields.character');
            } elseif ($type == 'is_private') {
                // Viewers can't see private
                if ($this->user->viewer()) {
                    return null;
                }
                $html = $this->route('is_private', trans('crud.fields.is_private'));
            } else {
                // No idea what is expected
                $html = null;
            }
        } else {
            // Now the 'fun' starts
            if (!empty($column['label'])) {
                $label = $column['label'];

                // We have a label, that's nice. If we have a custom render, we probably can't orderBy
                if (!empty($column['render'])) {
                    $html = $label;
                } else {
                    // So we have a label and no renderer, so we can order by. We just need a field
                    $html = $this->route($column['field'], $label);
                }
            } else {
                // No label? Sure, we can do this
                $html = null;
            }
        }

        return "<th" . (!empty($class) ? " class=\"$class\"" : null) . ">$html</th>\n";
    }

    /**
     * @param $label
     * @param null $field
     * @param array $options
     * @return string
     */
    private function route($field = null, $label = null, $options = [])
    {
        // Field is label
        if (empty($label)) {
            $label = $this->trans($field);
        }

        $routeOptions = [
            'order' => $field,
            'page' => request()->get('page')
        ];

        if (request()->has('order') && request()->get('order') == $field && !request()->has('desc')) {
            $routeOptions['desc'] = true;
        }
        if (request()->has('search')) {
            $routeOptions['search'] = request()->get('search');
        }

        return "<a href='" .
            url()->route($this->getOption('route'), $routeOptions). "'>" . $label . "</a>";
    }

    /**
     *
     */
    private function renderRows()
    {
        $html = '';
        foreach ($this->data as $model) {
            $html .= $this->renderRow($model);
        }
        return $html;
    }

    /**
     * @param Model $model
     */
    private function renderRow(Model $model)
    {
        $html =  '<tr>';
        foreach ($this->columns as $column) {
            $html .= $this->renderColumn($column, $model);
        }
        $html .= $this->renderActionRow($model);

        return $html . '</tr>';
    }

    /**
     * @param $column
     * @param $model
     * @return string
     */
    private function renderColumn($column, $model)
    {
        $class = null;
        $content = null;

        // Easy mode: String. Just return it, no need to make it complicated.
        if (is_string($column)) {
            // Just for name, a link to the view
            if ($column == 'name') {
                $route = route($this->getOption('baseRoute') . '.show', ['id' => $model->id]);
                $content = '<a href="' . $route . '">' . $model->{$column} . '</a>';
            } else {
                $content = $model->{$column};
            }
            return '<td>' . $content . '</td>';
        }

        // Check visibility
        if (isset($column['visible']) && $column['visible'] == false) {
            return null;
        }

        // Start with a pre-defined "type"
        if (!empty($column['type'])) {
            $type = $column['type'];
            if ($type == 'avatar') {
                $content = '<img class="direct-chat-img" src="' . $model->getImageUrl(true) .
                    '" alt="' . $model->name . '">';
            } elseif ($type == 'location') {
                if ($model->location) {
                    $content = '<a href="' . route('locations.show', $model->location->id) . '}">' .
                        $model->location->name . '</a>';
                } elseif ($model->parentLocation) {
                    $content = '<a href="' . route('locations.show', $model->parentLocation->id) . '}">' .
                        $model->parentLocation->name . '</a>';
                }
            } elseif ($type == 'character') {
                if ($model->character) {
                    $content = '<a href="' . route('characters.show', $model->character->id) . '}">' .
                        $model->character->name . '</a>';
                }
            } elseif ($type == 'is_private') {
                // Viewer can't see private
                if ($this->user->viewer()) {
                    return null;
                }
                $content = $model->is_private ?
                    '<i class="fa fa-lock" title="' . trans('crud.is_private') . '"></i>' :
                    '<br />';
            } else {
                // Exception
                $content = 'ERR_UNKNOWN_TYPE';
            }
        } elseif (!empty($column['render'])) {
            // If it's not a type, do we have a renderer?
            $content = $column['render']($model, $column);
        } elseif (!empty($column['field'])) {
            // A field was given? This could be when a field needs another label than anticipated.
            $content = $model->{$column['field']};
        } else {
            // I have no idea.
            $content = 'ERR_UNKNOWN';
        }

        return '<td' . (!empty($class) ? ' class="' . $class . '"' : null) . '>' . $content . '</td>';
    }

    /**
     * @param $option
     * @return mixed|null
     */
    private function getOption($option)
    {
        if (!empty($this->options[$option])) {
            return $this->options[$option];
        }
        return null;
    }

    /**
     * @param string $field
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    private function trans($field = '')
    {
        $trans = $this->getOption('trans');
        if (!empty($trans)) {
            return trans(rtrim($trans, '.') . '.' . $field);
        }
        // No idea what to do!
        return $field;
    }

    private function renderActionRow(Model $model)
    {
        $content = '
        <a href="' . route($this->getOption('baseRoute') . '.show', ['id' => $model->id]) .
            '" class="btn btn-xs btn-default">
            <i class="fa fa-eye" aria-hidden="true"></i> ' . trans('crud.view') . '
        </a>';

        if ($this->user->can('update', $model)) {
            $content .= ' <a href="' . route($this->getOption('baseRoute') . '.edit', ['id' => $model->id]) . '" class="btn btn-xs btn-primary">
                <i class="fa fa-pencil" aria-hidden="true"></i> ' . trans('crud.edit') . '
            </a>';
        }

        return '<td class="text-right">' . $content . '</td>';
    }
}