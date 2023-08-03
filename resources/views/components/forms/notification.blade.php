@props([])
<div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
    <form action="{{ route('requests.store') }}" method="POST">
        @csrf
        <x-forms.input label="Request Title:" placeholder="Enter a Title for your Notification" id="subject" />
        <x-forms.textarea label="Please explain your request in detail:" placeholder="Details of Service Request" id="content" />

        <div class="mt-4">
            <x-forms.button label="Submit Request"/>
        </div>
    </form>
</div>
