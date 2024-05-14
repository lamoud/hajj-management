<?php

namespace App\Livewire\Admin\Buildings;

use App\Exports\BuildingsExport;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Building;
use Maatwebsite\Excel\Facades\Excel;

class BuildingsDatatable extends DataTableComponent
{
    protected $model = Building::class;

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
            Column::make(__('Camp'), "camp.name"),
            Column::make(__('Pilgrims'))
                ->label(
                    fn($row, Column $column) => '<strong>'.$row->pilgrims->count().'</strong>'
                )
                ->html()
                ->sortable()
                ->deselected(),
            Column::make(__('Units'))
                ->label(
                    fn($row, Column $column) => '<strong>'.$row->units->count().'</strong>'
                )
                ->html()
                ->sortable()
                ->deselected(),
                Column::make("Season", "season.name")
                ->deselected(),
            Column::make(__('Address'), "address")
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
                    fn ($row, Column $column) => view('components.datatables.buildings.action-column')->with(
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
                return back()->withError('No buildings selected for export.');
            }
    
            // Create a new export instance with the selected IDs
            $export = new BuildingsExport($selectedIds);
    
            $this->clearSelected();

            // Download the file
            return Excel::download($export, 'buildings.xlsx');
    
        } catch (\Exception $e) {
            // Handle any exceptions and return with an error message
            return back()->withError('Failed to export selected buildings: ' . $e->getMessage());
        }
    }
    

    public function deleteSelected()
    {

        $selectedBuildingIds = $this->getSelected();
    
        // التحقق مما إذا كانت هناك جهات محددة لحذفها
        if (!empty($selectedBuildingIds)) {
            Building::whereIn('id', $selectedBuildingIds)->delete();
            $this->clearSelected();
            $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: __('تم حذف المخيمات بنجاح.'));
        }
    }

    public function startEdit( $id )
    {

        // Emit event to pass data to AgencyManagement page
        return $this->dispatch('editBuilding', id: $id);
    }

    public function startDelete( $id )
    {
        // Emit event to pass data to AgencyManagement page
        return $this->dispatch('deleteBuilding', id: $id);

    }

}
