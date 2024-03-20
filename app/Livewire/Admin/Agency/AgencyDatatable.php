<?php

namespace App\Livewire\Admin\Agency;

use App\Exports\agenciesExport;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Agency;
use Maatwebsite\Excel\Facades\Excel;

class AgencyDatatable extends DataTableComponent
{
    protected $model = Agency::class;

    
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
            Column::make(__('Description'), "description")
                ->sortable()
                ->deselected(),
            Column::make(__('Pilgrims'))
                ->label(
                    fn($row, Column $column) => '<strong>'.$row->pilgrims->count().'</strong>'
                )
                ->html()
                ->sortable()
                ->excludeFromColumnSelect(),
            Column::make(__('Phone'), "contact_number")
                ->sortable()
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
                    fn ($row, Column $column) => view('components.datatables.action-column')->with(
                        [
                            'viewLink' => '#',
                            'editLink' => $row->id,
                            'deleteLink' => '#',
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
            $export = new AgenciesExport($selectedIds);
    
            $this->clearSelected();

            // Download the file
            return Excel::download($export, 'agencies.xlsx');
    
        } catch (\Exception $e) {
            // Handle any exceptions and return with an error message
            return back()->withError('Failed to export selected agencies: ' . $e->getMessage());
        }
    }
    

    public function deleteSelected()
    {

        $selectedAgencyIds = $this->getSelected();
    
        // التحقق مما إذا كانت هناك جهات محددة لحذفها
        if (!empty($selectedAgencyIds)) {
            Agency::whereIn('id', $selectedAgencyIds)->delete();
            $this->clearSelected();
            $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: __('تم حذف الجهات بنجاح.'));
        }
    }

    public function startEdit( $id )
    {

        // Emit event to pass data to AgencyManagement page
        $this->dispatch('editAgency', [
            'id' => $id,
        ]);
    }

    
    // public function startEdit( $id )
    // {

    //     $this->active_agency( $id );

    //     return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.').$id);
    // }

}
