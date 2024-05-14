<?php

namespace App\Livewire\Admin\Units;

use App\Exports\UnitTypesExport;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\UnitType;
use Maatwebsite\Excel\Facades\Excel;

class UnitTypesDatatable extends DataTableComponent
{
    protected $model = UnitType::class;

    
    public function configure(): void
    {
        
        $this->setPrimaryKey('id');
        $this->setEmptyMessage('No data');
        $this->setRememberColumnSelectionEnabled();
        $this->setDefaultSort('created_at', 'desc');
        $this->setHideBulkActionsWhenEmptyStatus(true);
        $this->setSearchDebounce(1000);

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
            Column::make(__('Description'), "description")
                ->sortable()
                ->searchable()
                ->deselected(),
            Column::make(__('Created at'), "created_at")
                ->sortable()
                ->deselected(),
            Column::make(__('Last update'), "updated_at")
                ->sortable()
                ->deselected(),
            Column::make(__('Action' ))
                ->label(
                    fn ($row, Column $column) => view('components.datatables.units.action-column')->with(
                        [
                            'viewLink' => $row->id,
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
                return back()->withError('No units selected for export.');
            }
    
            // Create a new export instance with the selected IDs
            $export = new UnitTypesExport($selectedIds);
    
            $this->clearSelected();

            // Download the file
            return Excel::download($export, 'units.xlsx');
    
        } catch (\Exception $e) {
            // Handle any exceptions and return with an error message
            return back()->withError('Failed to export selected units: ' . $e->getMessage());
        }
    }
    
    public function deleteSelected()
    {

        $selectedUnitTypeIds = $this->getSelected();
    
        // التحقق مما إذا كانت هناك جهات محددة لحذفها
        if (!empty($selectedUnitTypeIds)) {
            UnitType::whereIn('id', $selectedUnitTypeIds)->delete();
            $this->clearSelected();
            $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: __('تم حذف المخيمات بنجاح.'));
        }
    }

    public function startEdit( $id )
    {

        // Emit event to pass data to AgencyManagement page
        return $this->dispatch('editUnitType', id: $id);
    }

    public function startDelete( $id )
    {
        // Emit event to pass data to AgencyManagement page
        return $this->dispatch('deleteUnitType', id: $id);

    }

}
