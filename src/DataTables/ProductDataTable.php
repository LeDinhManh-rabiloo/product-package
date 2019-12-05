<?php

namespace Manhle\RolePackage\DataTables;

use App\Models\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('cover', 'backs.pages.product.images')
            ->addColumn('action', 'backs.pages.product.actions')
            ->addColumn('description', 'backs.pages.product.description')
            ->addColumn('name', 'backs.pages.product.name')
            ->addColumn('slug', 'backs.pages.product.slug')
            ->rawColumns(['cover', 'action', 'description', 'name', 'status', 'slug']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\ProductDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('product-dt')
            ->addTableClass('table table-hover table-bordered table-striped')
            ->stateSave(true)
            ->columns($this->getColumns())
            ->responsive(false)
            // ->select(['style' => 'os', 'items' => 'row'])
            ->minifiedAjax()
            ->lengthMenu([20, 50, 100, 200])
            ->pageLength(100)
            ->orderBy(0)
            ->domBs4()
            ->buttons(
                Button::make('pageLength'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('name')
                ->exportable(false)
                ->printable(false)
                ->width(80)
                ->addClass('text-center'),
            Column::computed('cover')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
            Column::make('description')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('slug'),
            Column::make('price'),
            Column::make('active'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Product_' . date('YmdHis');
    }
}
