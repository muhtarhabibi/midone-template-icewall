<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Paginator::defaultView('vendor.pagination.tailwind');
        Paginator::defaultSimpleView('vendor.pagination.simple-tailwind');

        Form::component('luxText', 'shared.components.text_field', ['name', 'label' , 'value' => null, 'attributes' => []]);
        Form::component('luxMoney', 'shared.components.money_field', ['name', 'label' , 'value' => null, 'attributes' => []]);
        Form::component('luxTextarea', 'shared.components.textarea_field', ['name', 'label' , 'value' => null, 'attributes' => []]);
        Form::component('luxDate', 'shared.components.date_field', ['name', 'label' , 'value' => null, 'attributes' => []]);
        Form::component('luxEmail', 'shared.components.email_field', ['name', 'label', 'value' => null, 'attributes' => []]);
        Form::component('luxNumber', 'shared.components.number_field', ['name', 'label', 'value' => null, 'attributes' => []]);
        Form::component('luxSelect', 'shared.components.select_field', ['name', 'label', 'options' => [], 'value' => null, 'attributes' => []]);
        Form::component('luxSelectRemote', 'shared.components.select_remote_field', ['name', 'label', 'source', 'value' => null, 'attributes' => []]);
        Form::component('luxPassword', 'shared.components.password_field', ['name', 'label', 'attributes' => []]);
        Form::component('luxCheckbox', 'shared.components.checkbox_field', ['name', 'label', 'value' => null, 'attributes' => []]);
        Form::component('luxFile', 'shared.components.file_field', ['name', 'label', 'attributes' => []]);
        Form::component('luxSubmit', 'shared.components.submit_btn', ['label', 'class' => 'btn-primary']);
        Form::component('luxFilterText', 'shared.components.filter_text', ['name', 'label', 'filter', 'attributes' => []]);
        Form::component('luxFilterSelect', 'shared.components.filter_select', ['name', 'options' => [], 'label', 'filter']);
        Form::component('luxFilterDate', 'shared.components.filter_date', ['name', 'label', 'filter']);
        Form::component('luxFilterSort', 'shared.components.filter_sort', []);
        Form::component('luxFilterBtn', 'shared.components.filter_btn', ['label']);
    }
}
