<?php

namespace App\Livewire\Admin\Buses;

use App\Exports\BusesExport;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Bus;
use Maatwebsite\Excel\Facades\Excel;

class BusesDatatable extends DataTableComponent
{
    protected $model = Bus::class;

    
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
            Column::make(__('Bus number'), "name")
                ->sortable()
                ->searchable(),
            Column::make(__('Board number'), "number")
                ->sortable()
                ->searchable(),
            Column::make(__('Declaration'), "declaration")
                ->sortable()
                ->searchable(),
            Column::make(__('Number of sets'), "capacity")
                ->sortable()
                ->searchable(),
            Column::make(__('Description'), "description")
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
                    fn ($row, Column $column) => view('components.datatables.buses.action-column')->with(
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
                return back()->withError('No buses selected for export.');
            }
    
            // Create a new export instance with the selected IDs
            $export = new BusesExport($selectedIds);
    
            $this->clearSelected();

            // Download the file
            return Excel::download($export, 'buses.xlsx');
    
        } catch (\Exception $e) {
            // Handle any exceptions and return with an error message
            return back()->withError('Failed to export selected buses: ' . $e->getMessage());
        }
    }
    

    public function deleteSelected()
    {

        $selectedBusIds = $this->getSelected();
    
        if (!empty($selectedBusIds)) {
            Bus::whereIn('id', $selectedBusIds)->delete();
            $this->clearSelected();
            $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: __('تم حذف المخيمات بنجاح.'));
        }
    }

    public function startEdit( $id )
    {

        // Emit event to pass data to AgencyManagement page
        return $this->dispatch('editBus', id: $id);
    }

    public function startDelete( $id )
    {
        // Emit event to pass data to AgencyManagement page
        return $this->dispatch('deleteBus', id: $id);

    }

}
