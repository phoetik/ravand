<?php

namespace Ravand\Tables;

use \WP_List_Table as ListTable;

class PanelTable extends ListTable
{
    public function get_columns()
    {
        $columns = [
            // 'cb'    => '<input type="checkbox" />',
            'name'  => 'Name',
            'type'  => 'Type',
            'title' => 'Title',
        ];

        return $columns;
    }

    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = array();
        $this->_column_headers = array($columns, $hidden, $sortable);
            
        $this->items = [
            [
                // 'cb'    => '<input type="checkbox" />',
                'Name'  => 'Mamdadmaiefaebnfa',
                'type'  => 'Bul',
                'title' => 'DAFadfeaf',
            ],
            [
                // 'cb'    => '<input type="checkbox" />',
                'name'  => 'Cringe',
                'type'  => 'Giga Chad',
                'title' => 'Bingus',
            ],
            [
                // 'cb'    => '<input type="checkbox" />',
                'name'  => 'Tesla',
                'type'  => 'Ancap',
                'title' => 'FEarth',
            ]
        ];
    }
}
