@component('mail::message')
# {{ date('d-m-Y') }} Expenses

The attached pdf contains your expenses up until {{ date('d-m-Y')}}.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
