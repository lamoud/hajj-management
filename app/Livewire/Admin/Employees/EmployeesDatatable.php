<?php

namespace App\Livewire\Admin\Employees;

use App\Exports\EmployeesExport;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Employe;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use Intervention\Image\ImageManager;
use Intervention\Image\Typography\FontFactory;
use Intervention\Image\Drivers\Imagick\Driver;

use function PHPSTORM_META\type;

class EmployeesDatatable extends DataTableComponent
{
    protected $model = Employe::class;

    
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
                ->format(function($value, $row, $column) {
                    $image = isset($row->image) && !empty($row->image)
                        ? '<img src="'.$row->image.'" style="width:30px; height:30px; border-radius:50%; margin-right:10px;" />'
                        : '<div style="width:30px; height:30px; border-radius:50%; background:#ccc; display:inline-block; margin-right:10px;"></div>';

                    $name = e($row->name);

                    return '<div style="display:flex; align-items:center;">'.$image.'<span>'.$name.'</span></div>';
                })
                ->html()
                ->sortable()
                ->searchable()
                ->secondaryHeaderFilter('name')
                ->excludeFromColumnSelect(),
            Column::make('الصورة الشخصية', 'image')
                ->format(function($value, $row, $column) {
                    if (isset($row->image) && !empty($row->image)) {
                        return '<a href="'.$row->image.'" target="_blank"><img src="'.$row->image.'" style="width:50px"></img></a>';
                    } else {
                        return '';
                    }
                })
                ->sortable()
                ->searchable()
                ->html(),
            Column::make('الوظيفة', "position.name")
                ->sortable(),
            Column::make(__('Employe number'), "number")
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
            Column::make(__('Created at'), "created_at")
                ->sortable()
                ->deselected(),
            Column::make(__('Last update'), "updated_at")
                ->sortable()
                ->deselected(),
            Column::make(__('Print' ))
                ->label(
                    fn ($row, Column $column) => view('components.datatables.employees.print-column')->with(
                        [
                            'unit_id' => $row->unit_id,
                            'number' => $row->number,
                            'national_id' => $row->national_id,
                            'employees_id' => $row->id,
                        ]
                    )
                )->html()
                ->deselected(),
            Column::make('ظهر الهوية', 'back_id_card')
                ->format(function($value, $row, $column) {
                    if (isset($row->back_id_card) && !empty($row->back_id_card)) {
                        return '<a href="'.$row->back_id_card.'" target="_blank"><img src="'.$row->back_id_card.'" style="width:50px"></img></a>';
                    } else {
                        return '';
                    }
                })
                ->sortable()
                ->searchable()
                ->html(),
            Column::make('وجه الهوية', 'front_id_card')
                ->format(function($value, $row, $column) {
                    if (isset($row->front_id_card) && !empty($row->front_id_card)) {
                        return '<a href="'.$row->front_id_card.'" target="_blank"><img src="'.$row->front_id_card.'" style="width:50px"></img></a>';
                    } else {
                        return '';
                    }
                })
                ->sortable()
                ->searchable()
                ->html(),
            Column::make(__('Action' ))
                ->label(
                    fn ($row, Column $column) => view('components.datatables.employees.action-column')->with(
                        [
                            'editLink' => $row->id,
                            'deleteLink' => $row->id,
                        ]
                    )
                )->html()
                ->excludeFromColumnSelect(),
        ];
    }

    public function printCard($type, $employeIdd)
    {
        $employe = Employe::find($employeIdd);
    
        if (!$employe) {
            return $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على بطاقة الحاج!');
        }
    
        if (!isset($employe->camp) || !isset($employe->camp->front_pilgrim_card) || !isset($employe->unit)) {
            return $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على سكن الحاج، أو أن المخيم ليس له بطاقة!');
        }
    
        $imagePath = $employe->camp->front_pilgrim_card;
    
        return $this->dispatch(
            'printImage',
            type: $type,
            url: $imagePath,
            name: $employe->name,
            id: $employe->national_id,
            unit: $employe->unit->name,
            number: $employe->number,
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
                return back()->withError('No employees selected for export.');
            }
    
            // Create a new export instance with the selected IDs
            $export = new EmployeesExport($selectedIds);
    
            $this->clearSelected();

            // Download the file
            return Excel::download($export, 'employees.xlsx');
    
        } catch (\Exception $e) {
            // Handle any exceptions and return with an error message
            return back()->withError('Failed to export selected employees: ' . $e->getMessage());
        }
    }
    
    public function deleteSelected()
    {

        $selectedEmployeIds = $this->getSelected();
    
        // التحقق مما إذا كانت هناك جهات محددة لحذفها
        if (!empty($selectedEmployeIds)) {
            Employe::whereIn('id', $selectedEmployeIds)->delete();
            $this->clearSelected();
            $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: __('تم حذف الموظفين بنجاح.'));
        }
    }

    public function startEdit( $id )
    {
        // Emit event to pass data to AgencyManagement page
        return $this->dispatch('editEmploye', id: $id);
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
