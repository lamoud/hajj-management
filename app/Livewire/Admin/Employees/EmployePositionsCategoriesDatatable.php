<?php

namespace App\Livewire\Admin\Employees;

use App\Exports\agenciesExport;
use App\Exports\EmployesPositionsCategoryExport;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\EmployesJob;
use App\Models\employesJobsCategory;
use Maatwebsite\Excel\Facades\Excel;

class EmployePositionsCategoriesDatatable extends DataTableComponent
{
    protected $model = employesJobsCategory::class;

    
    public function configure(): void
    {
        
        $this->setPrimaryKey('id');
        $this->setEmptyMessage('No data');
        $this->setRememberColumnSelectionEnabled();
        $this->setDefaultSort('created_at', 'desc');
        $this->setHideBulkActionsWhenEmptyStatus(true);
        $this->setSearchDebounce(1000);
        //$this->setColumnSelectStatus(false);
        //$this->setSingleSortingDisabled();

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

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(__('Name'), "name")
                ->sortable()
                ->searchable()
                ->excludeFromColumnSelect(),
            Column::make('المسميات الوظيفية', 'id')
                ->format(function($value, $row, $column) {
                    return '<p>'.$row->positions->count().'</p>';
                })
                ->sortable()
                ->searchable()
                ->html(),
            Column::make(__('Description'), "content")
                ->sortable()
                ->deselected(),
            Column::make(__('Created at'), "created_at")
                ->sortable()
                ->deselected(),
            Column::make(__('Last update'), "updated_at")
                ->sortable()
                ->deselected(),
            Column::make(__('Action' ))
                ->label(
                    fn ($row, Column $column) => view('components.datatables.action-column')->with(
                        [
                            'editLink' => $row->id,
                            // 'deleteLink' => $row->id,
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
                return back()->withError('No agencies selected for export.');
            }
    
            // Create a new export instance with the selected IDs
            $export = new EmployesPositionsCategoryExport($selectedIds);
    
            $this->clearSelected();

            // Download the file
            return Excel::download($export, 'employesPositionsCategoryExport.xlsx');
    
        } catch (\Exception $e) {
            // Handle any exceptions and return with an error message
            return back()->withError('Failed to export selected agencies: ' . $e->getMessage());
        }
    }
    

    public function deleteSelected()
    {

        $selectedEmployeIds = $this->getSelected();
    
        // التحقق مما إذا كانت هناك جهات محددة لحذفها
        if (!empty($selectedEmployeIds)) {
            employesJobsCategory::whereIn('id', $selectedEmployeIds)->delete();
            $this->clearSelected();
            $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: __('تم حذف التصنيفات بنجاح.'));
        }
    }

    public function startEdit( $id )
    {

        // Emit event to pass data to EmployeManagement page
        $this->dispatch('editConfirm', id: $id);
    }


}
