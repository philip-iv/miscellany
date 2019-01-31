<?php

return [
    'characters'    => [
        'description'   => 'Personaggi presenti nel luogo.',
        'title'         => 'Personaggi del Luogo :name',
    ],
    'create'        => [
        'description'   => 'Crea un nuovo luogo',
        'success'       => 'Luogo \':name\' creato.',
        'title'         => 'Nuovo Luogo',
    ],
    'destroy'       => [
        'success'   => 'Luogo \':name\' rimosso.',
    ],
    'edit'          => [
        'success'   => 'Luogo \':name\' aggiornato.',
        'title'     => 'Modifica Luogo :name',
    ],
    'events'        => [
        'description'   => 'Eventi accaduti nel luogo',
        'title'         => 'Eventi del Luogo :name',
    ],
    'fields'        => [
        'characters'    => 'Personaggi',
        'image'         => 'Immagine',
        'location'      => 'Luogo',
        'locations'     => 'Luoghi',
        'map'           => 'Mappa',
        'name'          => 'Nome',
        'relation'      => 'Relazione',
        'type'          => 'Tipo',
    ],
    'helpers'       => [
        'descendants'   => 'La lista contiene tutti i luoghi discendenti di questo luogo, non solo quelli direttamente sotto di esso.',
        'nested'        => 'Quando ci si trova nella Vista Nidificata puoi visualizzare la gerarchia dei tuoi luoghi. I luoghi senza padri saranno mostrati per impostazione predefinita. I luoghi con dei figli invece potranno essere premuti per mostrare questi figli. Si potrà continuare ad espandere la gerarchia fino a quando non ci saranno più luoghi da mostrare.',
    ],
    'index'         => [
        'actions'       => [
            'explore_view'  => 'Vista Annidata',
        ],
        'add'           => 'Nuovo Luogo',
        'description'   => 'Gestisci i luoghi di :name',
        'header'        => 'Luoghi di :name',
        'title'         => 'Luoghi',
    ],
    'items'         => [
        'description'   => 'Oggetti presenti o originari del luogo',
        'title'         => 'Oggetti del Luogo :name',
    ],
    'locations'     => [
        'description'   => 'Luoghi presenti nel luogo',
        'title'         => 'Luoghi del Luogo :name',
    ],
    'map'           => [
        'actions'   => [
            'admin_mode'    => 'Abilita la Modalità Modifica',
            'big'           => 'Vista Completa',
            'download'      => 'Scarica',
            'points'        => 'Modifica i Punti',
            'toggle_hide'   => 'Nascondi i Punti',
            'toggle_show'   => 'Mostra i Punti',
            'view_mode'     => 'Torna alla visualizzazione',
            'zoom_in'       => 'Zoom In',
            'zoom_out'      => 'Zoom Out',
            'zoom_reset'    => 'Reimposta lo Zoom',
        ],
        'helper'    => 'Clicca sulla mappa per aggiungere un nuovo punto ad un luogo, o clicca su un punto esistente per modificarlo o cancellarlo.',
        'helpers'   => [
            'admin' => 'Attiva per abilitare l\'aggiunta di nuovi punti con un semplice click, premi sui punti per modificarli o per spostarli.',
            'label' => 'Questo punto è un\'etichetta. Niente di più, niente di meno.',
            'view'  => 'Premi su un qualsiasi punto della mappa per vederne i dettagli. Utilizza Ctrl+Zoom per aumentare o diminuire lo zoom della mappa.',
        ],
        'modal'     => [
            'submit'    => 'Aggiungi',
            'title'     => 'Bersaglio del nuovo punto',
        ],
        'no_map'    => 'Per favore aggiungi una mappa del luogo',
        'points'    => [
            'fields'        => [
                'axis_x'    => 'Asse X',
                'axis_y'    => 'Asse Y',
                'colour'    => 'Colore',
                'icon'      => 'Icona',
                'name'      => 'Etichetta',
                'shape'     => 'Forma',
                'size'      => 'Dimensione',
            ],
            'helpers'       => [
                'location_or_name'  => 'Un punto della mappa può puntare ad un luogo esistente, o avere semplicemente una targhetta.',
            ],
            'icons'         => [
                'anvil'         => 'Incudine',
                'aura'          => 'Aura',
                'axe'           => 'Ascia',
                'beer'          => 'Birra',
                'book'          => 'Libro',
                'bridge'        => 'Ponte',
                'campfire'      => 'Fuco da campo',
                'player'        => 'Personaggio',
                'dragon'        => 'Drago',
                'entity'        => 'Immagine dell\'Entità bersaglio',
                'fire'          => 'Fuoco',
                'pin'           => 'Spillo',
                'wooden-sign'   => 'Cartello di Legno',
                'shield'        => 'Scudo',
                'skull'         => 'Teschio',
                'spades-card'   => 'Carta di Picche',
                'sprout'        => 'Germoglio',
                'tentacle'      => 'Tentacolo',
                'tower'         => 'Torre',
            ],
            'modal'         => 'Crea o modifica un punto della mappa',
            'placeholders'  => [
                'axis_x'    => 'Posizione sinistra',
                'axis_y'    => 'Posizione in alto',
                'name'      => 'Targhetta del punto quando non c\'è un luogo',
            ],
            'return'        => 'Indietro verso :name',
            'shapes'        => [
                'circle'    => 'Cerchio',
                'square'    => 'Quadrato',
            ],
            'sizes'         => [
                'large'     => 'Grande',
                'small'     => 'Piccolo',
                'standard'  => 'Normale',
            ],
            'success'       => [
                'create'    => 'Punto della Mappa del Luogo creato.',
                'delete'    => 'Punto della Mappa del Luogo rimosso.',
                'update'    => 'Punto della Mappa del Luogo aggiornato.',
            ],
            'title'         => 'Punti della Mappa del Luogo :name',
        ],
        'success'   => 'Punto della Mappa salvato.',
    ],
    'organisations' => [
        'description'   => 'Organizzazioni situate nel luogo.',
        'title'         => 'Organizzazioni del Luogo :name',
    ],
    'placeholders'  => [
        'location'  => 'Scegli un Luogo padre',
        'name'      => 'Nome del luogo',
        'type'      => 'Città, Regno, Rovina',
    ],
    'quests'        => [
        'description'   => 'Missione di cui fa parte il luogo.',
        'title'         => 'Missioni del Luogo :name',
    ],
    'show'          => [
        'description'   => 'Una vista dettagliata del luogo',
        'tabs'          => [
            'characters'    => 'Personaggi',
            'events'        => 'Eventi',
            'information'   => 'Informazioni',
            'items'         => 'Oggetti',
            'locations'     => 'Luoghi',
            'map'           => 'Mappa',
            'menu'          => 'Menu',
            'organisations' => 'Organizzazioni',
            'quests'        => 'Missioni',
        ],
        'title'         => 'Luogo :name',
    ],
];
