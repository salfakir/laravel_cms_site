<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\DateColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;

use function Illuminate\Log\log;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setFilterPillsItemAttributes([
            "class" => "bg-indigo-100 text-indigo-800",
        ]);
        /* $a= new Filter("asdf"); */
        /* $a->setLabelAttributes([ */
        /*     'class' => 'bg-indigo-200 text-indigo-800', */
        /* ]); */
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()->excludeFromColumnSelect(),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Email", "email")
                ->sortable()
                ->searchable(),
            DateColumn::make("Created at", "created_at")
                ->inputFormat('Y-m-d H:i:s')
                ->outputFormat('d/m/Y')
                ->excludeFromColumnSelect()
                ->sortable(),
            DateColumn::make("Updated at", "updated_at")
                ->inputFormat('Y-m-d H:i:s')
                ->outputFormat('d/m/Y')
                ->excludeFromColumnSelect()
                ->sortable(),
        ];
    }
    public function filters(): array
    {
        $fil =            TextFilter::make('Name')
            ->config([
                'placeholder' => 'Search Name',
                'maxlength' => '25',
            ])
            ->filter(function (Builder $builder, string $value) {
                $builder->where('users.name', 'like', '%' . $value . '%');
            })
            ->setFilterLabelAttributes(
                [
                    //blue text
                    'class' => 'text-white',
                ]
            );
        /* log(get_class_methods($fil)); */

        return [
            $fil
        ];
    }
}
