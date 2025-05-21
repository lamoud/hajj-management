<?php

namespace App\Livewire\Admin\Employees;

use App\Exports\EmployeesExport;
use App\Exports\EmployeesRequestsExport;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\EmploymentApplication;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;


class EmployeesRequestsDatatable extends DataTableComponent
{
    protected $model = EmploymentApplication::class;

    
    public function configure(): void
    {
        
        $this->setPrimaryKey('id');
        $this->setEmptyMessage('No data');
        $this->setRememberColumnSelectionEnabled();
        $this->setDefaultSort('created_at', 'desc');
        $this->setHideBulkActionsWhenEmptyStatus(true);
        $this->setSearchDebounce(1000);

        $this->setSecondaryHeaderTrAttributes(function($rows) {
            return ['class' => 'lm-filtrs'];
        });

        $this->setBulkActionConfirmMessages([
            'deleteSelected' => 'Are you sure you want to delete these items?',
        ]);

        $this->setBulkActionsThAttributes([
            'class' => 'lm-td',
            'default' => true
        ]);

        $this->setBulkActionsTdAttributes([
            'class' => 'lm-td',
            'default' => true
        ]);
    }

    public function filters(): array
    {
        return [
            TextFilter::make('name')
                ->config([
                    'placeholder' => __('Search'),
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('employes.name', 'like', '%'.$value.'%');
                }),
            TextFilter::make('number')
                ->config([
                    'placeholder' => __('Search'),
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('employes.number', 'like', '%'.$value.'%');
                }),
            TextFilter::make('declaration')
                ->config([
                    'placeholder' => __('Search'),
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('employes.declaration', 'like', '%'.$value.'%');
                }),
            TextFilter::make('national_id')
                ->config([
                    'placeholder' => __('Search'),
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('employes.national_id', 'like', '%'.$value.'%');
                }),
            TextFilter::make('national_id')
                ->config([
                    'placeholder' => __('Search'),
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('employes.national_id', 'like', '%'.$value.'%');
                }),
            TextFilter::make('phone')
                ->config([
                    'placeholder' => __('Search'),
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('employes.phone', 'like', '%'.$value.'%');
                }),
            TextFilter::make('phone2')
                ->config([
                    'placeholder' => __('Search'),
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('employes.phone2', 'like', '%'.$value.'%');
                }),
            TextFilter::make('agency')
                ->config([
                    'placeholder' => __('Search'),
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->join('agencies', 'employees.agency_id', '=', 'agencies.id')
                            ->where('agencies.name', 'like', '%'.$value.'%');
                }),
            TextFilter::make('camp')
                ->config([
                    'placeholder' => __('Search'),
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    // تأكد من أن هناك join على جدول 'camps' للوصول إلى الحقل 'name'
                    $builder->join('camps', 'employes.camp_id', '=', 'camps.id')
                            ->where('camps.name', 'like', '%'.$value.'%');
                }),
            TextFilter::make('unit')
                ->config([
                    'placeholder' => __('Search'),
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    // تأكد من أن هناك join على جدول 'camps' للوصول إلى الحقل 'name'
                    $builder->join('units', 'employes.unit_id', '=', 'unit.id')
                            ->where('units.name', 'like', '%'.$value.'%');
                }),
            SelectFilter::make('gender')
            ->options([
                '' => __('All'),
                'male' => __('Male'),
                'female' => __('Female'),
            ]),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(__('Name'), "name")
                ->sortable()
                ->searchable()
                ->secondaryHeaderFilter('name')
                ->excludeFromColumnSelect(),
            Column::make('الوظيفة', "position.name")
                ->sortable(),
            Column::make('العمر', "age")
                ->sortable()
                ->searchable(),
            Column::make('سنوات الخبرة', "years_experience")
                ->sortable()
                ->searchable(),
            Column::make(__('Nationality'), "nationality")
                ->sortable()
                ->searchable(),
            Column::make(__('The gender'), "gender")
                ->sortable()
                ->secondaryHeaderFilter('gender')
                ->searchable(),
            Column::make(__('Phone'), 'phone')
                ->format(function($value, $row, $column) {
                    if (isset($row->phone) && !empty($row->phone)) {
                        return "<a href='tel:{$row->phone}'><i class='fa fa-mobile-phone'></i> {$row->phone}</a>";
                    } else {
                        return '';
                    }
                })
                ->secondaryHeaderFilter('phone')
                ->sortable()
                ->searchable()
                ->html(),
            Column::make(__('WhatsApp'), 'phone2')
                ->format(function($value, $row, $column) {
                    if (isset($row->phone2) && !empty($row->phone2)) {
                        return "<a href='https://wa.me/{$row->phone2}' target='_blank'><i class='fa fa-whatsapp'></i> {$row->phone2}</a>";
                    } else {
                        return '';
                    }
                })
                ->secondaryHeaderFilter('phone2')
                ->sortable()
                ->searchable()
                ->html(),
                Column::make(__('Season'), "season.name")
                    ->deselected(),
            Column::make(__('Created at'), "created_at")
                ->sortable()
                ->deselected(),
            Column::make(__('Last update'), "updated_at")
                ->sortable()
                ->deselected(),
            Column::make(__('Action' ))
                ->label(
                    fn ($row, Column $column) => view('components.datatables.employees.request-action-column')->with(
                        [
                            'editLink' => $row->id,
                            'deleteLink' => $row->id,
                        ]
                    )
                )->html()
                ->excludeFromColumnSelect(),
        ];
    }
    

    public function bulkActions(): array
    {
        return [
            'exportSelected' => __('Export'),
            'deleteSelected' => __('Delete'),
        ];
    }

    public function exportSelected()
    {
        try {
            // Extract the selected data
            $selectedIds = $this->getSelected();
            
            // If there are no selected agencies, return with an error message
            if (empty($selectedIds)) {
                return back()->withError('No employees selected for export.');
            }
    
            // Create a new export instance with the selected IDs
            $export = new EmployeesRequestsExport($selectedIds);
    
            $this->clearSelected();

            // Download the file
            return Excel::download($export, 'employeesRequestsExport.xlsx');
    
        } catch (\Exception $e) {
            // Handle any exceptions and return with an error message
            return back()->withError('Failed to export selected employees: ' . $e->getMessage());
        }
    }
    
    public function deleteSelected()
    {

        $selectedEmployeIds = $this->getSelected();
    
        if (!empty($selectedEmployeIds)) {
            EmploymentApplication::whereIn('id', $selectedEmployeIds)->delete();
            $this->clearSelected();
            $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: __('تم حذف الطلبات بنجاح.'));
        }
    }

    public function startEdit( $id )
    {

        // Emit event to pass data to AgencyManagement page
        return $this->dispatch('editEmployeRequest', id: $id);
    }

    public function startDelete( $id, $type = 'delete' )
    {
        // Emit event to pass data to AgencyManagement page
        return $this->dispatch('deleteEmploye', id: $id, type: $type);

    }

    public function startSwapAddress( $id )
    {
        // Emit event to pass data to AgencyManagement page
        return $this->dispatch('swapEmploye', id: $id);

    }

}
