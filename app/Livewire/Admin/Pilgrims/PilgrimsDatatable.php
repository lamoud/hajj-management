<?php

namespace App\Livewire\Admin\Pilgrims;

use App\Exports\PilgrimsExport;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Pilgrim;
use Maatwebsite\Excel\Facades\Excel;

class PilgrimsDatatable extends DataTableComponent
{
    protected $model = Pilgrim::class;

    
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
            Column::make(__('Pilgrim number'), "pilgrim_number")
                ->sortable()
                ->searchable(),
            Column::make(__('National id'), "national_id")
                ->sortable()
                ->searchable(),
            Column::make(__('Nationality'), "nationality")
                ->sortable()
                ->searchable(),
            Column::make(__('The gender'), "gender")
                ->sortable()
                ->searchable(),
            Column::make(__('Arrival'), "arrival_type")
                ->sortable()
                ->searchable(),
            Column::make(__('Phone'), "phone")
                ->sortable()
                ->searchable(),
                Column::make(__('Agency'), "agency.name")
                ->sortable()
                ->searchable(),
                Column::make(__('Camp'), "camp.name")
                ->sortable()
                ->searchable(),
                Column::make(__('Unit'), "unit.name")
                ->sortable()
                ->searchable(),
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
                    fn ($row, Column $column) => view('components.datatables.pilgrims.action-column')->with(
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
                return back()->withError('No pilgrims selected for export.');
            }
    
            // Create a new export instance with the selected IDs
            $export = new PilgrimsExport($selectedIds);
    
            $this->clearSelected();

            // Download the file
            return Excel::download($export, 'pilgrims.xlsx');
    
        } catch (\Exception $e) {
            // Handle any exceptions and return with an error message
            return back()->withError('Failed to export selected pilgrims: ' . $e->getMessage());
        }
    }
    
    public function deleteSelected()
    {

        $selectedPilgrimIds = $this->getSelected();
    
        // التحقق مما إذا كانت هناك جهات محددة لحذفها
        if (!empty($selectedPilgrimIds)) {
            Pilgrim::whereIn('id', $selectedPilgrimIds)->delete();
            $this->clearSelected();
            $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: __('تم حذف المخيمات بنجاح.'));
        }
    }

    public function startEdit( $id )
    {

        // Emit event to pass data to AgencyManagement page
        return $this->dispatch('editPilgrim', id: $id);
    }

    public function startDelete( $id )
    {
        // Emit event to pass data to AgencyManagement page
        return $this->dispatch('deletePilgrim', id: $id);

    }

}
