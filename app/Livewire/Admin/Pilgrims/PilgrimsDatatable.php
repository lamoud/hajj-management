<?php

namespace App\Livewire\Admin\Pilgrims;

use App\Exports\PilgrimsExport;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Pilgrim;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use Intervention\Image\ImageManager;
use Intervention\Image\Typography\FontFactory;
use Intervention\Image\Drivers\Imagick\Driver;

use function PHPSTORM_META\type;

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
                    $builder->where('pilgrims.name', 'like', '%'.$value.'%');
                }),
            TextFilter::make('number')
                ->config([
                    'placeholder' => __('Search'),
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('pilgrims.number', 'like', '%'.$value.'%');
                }),
            TextFilter::make('declaration')
                ->config([
                    'placeholder' => __('Search'),
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('pilgrims.declaration', 'like', '%'.$value.'%');
                }),
            TextFilter::make('national_id')
                ->config([
                    'placeholder' => __('Search'),
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('pilgrims.national_id', 'like', '%'.$value.'%');
                }),
            TextFilter::make('national_id')
                ->config([
                    'placeholder' => __('Search'),
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('pilgrims.national_id', 'like', '%'.$value.'%');
                }),
            TextFilter::make('phone')
                ->config([
                    'placeholder' => __('Search'),
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('pilgrims.phone', 'like', '%'.$value.'%');
                }),
            TextFilter::make('phone2')
                ->config([
                    'placeholder' => __('Search'),
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('pilgrims.phone2', 'like', '%'.$value.'%');
                }),
            TextFilter::make('agency')
                ->config([
                    'placeholder' => __('Search'),
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->join('agencies', 'pilgrims.agency_id', '=', 'agencies.id')
                            ->where('agencies.name', 'like', '%'.$value.'%');
                }),
            TextFilter::make('camp')
                ->config([
                    'placeholder' => __('Search'),
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    // تأكد من أن هناك join على جدول 'camps' للوصول إلى الحقل 'name'
                    $builder->join('camps', 'pilgrims.camp_id', '=', 'camps.id')
                            ->where('camps.name', 'like', '%'.$value.'%');
                }),
            TextFilter::make('unit')
                ->config([
                    'placeholder' => __('Search'),
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    // تأكد من أن هناك join على جدول 'camps' للوصول إلى الحقل 'name'
                    $builder->join('units', 'pilgrims.unit_id', '=', 'unit.id')
                            ->where('units.name', 'like', '%'.$value.'%');
                }),
            TextFilter::make('bus')
                ->config([
                    'placeholder' => __('Search'),
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->join('buses', 'pilgrims.bus_id', '=', 'buses.id')
                            ->where('buses.name', 'like', '%'.$value.'%');
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
            Column::make(__('Pilgrim number'), "number")
                ->sortable()
                ->secondaryHeaderFilter('number')
                ->searchable(),
            Column::make(__('Declaration'), "declaration")
                ->sortable()
                ->secondaryHeaderFilter('declaration')
                ->searchable(),
            Column::make(__('National id'), "national_id")
                ->sortable()
                ->secondaryHeaderFilter('national_id')
                ->searchable(),
            Column::make(__('Nationality'), "nationality")
                ->sortable()
                ->searchable(),
            Column::make(__('The gender'), "gender")
                ->sortable()
                ->secondaryHeaderFilter('gender')
                ->searchable(),
            Column::make(__('Arrival'), "arrival_type")
                ->sortable()
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
                Column::make(__('Agency'), "agency.name")
                ->sortable()
                ->secondaryHeaderFilter('agency')
                ->searchable(),
                Column::make(__('Camp'), "camp.name")
                ->sortable()
                ->secondaryHeaderFilter('camp')
                ->searchable(),
                Column::make('', "unit_id"),
                Column::make(__('Unit'), "unit.name")
                ->sortable()
                ->secondaryHeaderFilter('unit')
                ->searchable(),
            Column::make(__('Season'), "season.name")
                ->deselected(),
            Column::make(__('Bus'), 'bus.name')
                ->format(fn($value, $row) => view('components.datatables.buses.bus-name-button', [
                    'busName' => $value,
                    'pilgrimId' => $row->id,
                ]))
                ->sortable()
                ->searchable()
                ->secondaryHeaderFilter('bus'),
            Column::make(__('Created at'), "created_at")
                ->sortable()
                ->deselected(),
            Column::make(__('Last update'), "updated_at")
                ->sortable()
                ->deselected(),
            Column::make(__('Print' ))
                ->label(
                    fn ($row, Column $column) => view('components.datatables.pilgrims.print-column')->with(
                        [
                            'unit_id' => $row->unit_id,
                            'number' => $row->number,
                            'national_id' => $row->national_id,
                            'pilgrims_id' => $row->id,
                        ]
                    )
                )->html()
                ->deselected(),
            Column::make(__('Action' ))
                ->label(
                    fn ($row, Column $column) => view('components.datatables.pilgrims.action-column')->with(
                        [
                            'swapLink' => $row->id,
                            'editLink' => $row->id,
                            'deleteLink' => $row->id,
                        ]
                    )
                )->html()
                ->excludeFromColumnSelect(),
        ];
    }

    public function printCard($type, $pilgrimIdd)
    {
        $pilgrim = Pilgrim::find($pilgrimIdd);
    
        if (!$pilgrim) {
            return $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على بطاقة الحاج!');
        }
    
        if (!isset($pilgrim->camp) || !isset($pilgrim->camp->front_pilgrim_card) || !isset($pilgrim->unit)) {
            return $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على سكن الحاج، أو أن المخيم ليس له بطاقة!');
        }
    
        $imagePath = $pilgrim->camp->front_pilgrim_card;
    
        return $this->dispatch(
            'printImage',
            type: $type,
            url: $imagePath,
            name: $pilgrim->name,
            id: $pilgrim->national_id,
            unit: $pilgrim->unit->name,
            number: $pilgrim->number,
        );
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

    public function startDelete( $id, $type )
    {
        // Emit event to pass data to AgencyManagement page
        return $this->dispatch('deletePilgrim', id: $id);

    }

    public function startSwapAddress( $id )
    {
        // Emit event to pass data to AgencyManagement page
        return $this->dispatch('swapPilgrim', id: $id);

    }

    public function openBusModal($pilgrimId)
    {
        return $this->dispatch('swapPus', id: $pilgrimId);
    }

}
