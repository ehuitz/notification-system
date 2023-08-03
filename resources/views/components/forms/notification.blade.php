@props([])
<div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
    <form action="{{ route('requests.store') }}" method="POST">
        @csrf
        <x-forms.input label="Title:" placeholder="Enter a Title for your Notification" id="subject" />
        <x-forms.textarea label="Please explain your notification in detail:" placeholder="Details of Notification" id="content" />
        <x-forms.date label="Date:" id="date" />
        <x-forms.time label="Time:" id="time" />
        <div class="mt-4">
            <x-forms.button label="Submit Notification"/>
        </div>
    </form>
</div>
