@extends('layouts.app')
@section('CSS')
<link rel="stylesheet" href="{{ url('/') }}/assets/css/cute.css">
<style>
    .fc-daygrid-event-harness {
        right: 0 !important;
        width: auto !important;
    }
    .fc-title {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@endsection
@section('background')
<div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
@endsection
@section('title')
Holidays
@endsection
@section('subTitle')
Holidays
@endsection
@section('content')
<div class="px-10 bg-white py-5 rounded-3 shadow-lg dark:bg-slate-850 dark:shadow-dark-xl mb-5">
    <div>
        <div id="calendar"></div>
    </div>
</div>
<div class="relative z-990" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="modal" style="display: none">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 dark:bg-black dark:bg-opacity-50 transition-opacity"></div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="text-center border-b">
                        <p class="text-black font-bold text-5">Add Holiday</p>
                    </div>
                    <div class="text-left mt-5">
                        <p>Select Employee </p>
                        <select class="w-full rounded" name="employee" id="employee">
                            <option value="">Select Employee</option>
                            @foreach ($employess as $employee)
                            <option value="{{ $employee->user_id }}">{{ $employee->fname }} {{ $employee->lname }}</option>
                            @endforeach
                        </select>
                        <p class="mt-3">Date Start</p>
                        <input type="datetime-local" name="dateStart" id="dateStart" class="w-full rounded" />
                        <p class="danger bg-red-500 py-1 px-2 rounded-2 text-white my-2" id="dateStartError" style="display: none"></p>
                        <p class="mt-3">Date End</p>
                        <input type="datetime-local" name="dateEnd" id="dateEnd" class="w-full rounded" />
                        <p class="danger bg-red-500 py-1 px-2 rounded-2 text-white my-2" id="dateEndError" style="display: none"></p>
                        <p class="mt-3">Status</p>
                        <select class="w-full rounded" id="statusCreate" name="statusCreate">
                            <option value="Pending">Pending</option>
                            <option value="Accepted">Accepted</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                        <p class="mt-3">Event</p>
                        <input type="text" name="event" id="event" class="w-full rounded" />
                        <p class="danger bg-red-500 py-1 px-2 rounded-2 text-white my-2" id="eventError" style="display: none"></p>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm" onclick="submitHandler()">Submit</button>
                    <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="modalHandler()">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="relative z-990" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="modal_Edit" style="display: none">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 dark:bg-black dark:bg-opacity-50 transition-opacity"></div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="text-center border-b">
                        <p class="text-black font-bold text-5">Add Holiday</p>
                    </div>
                    <div class="text-left mt-5">
                        <p>Select Employee</p>
                        <select class="w-full rounded" name="employee" id="employeeEdit">
                            <option value="">Select Employee</option>
                            @foreach ($employess as $employee)
                            <option value="{{ $employee->user_id }}">{{ $employee->fname }} {{ $employee->lname }}</option>
                            @endforeach
                        </select>
                        <p class="mt-3">Date Start</p>
                        <input type="datetime-local" name="dateStart" id="dateStartEdit" class="w-full rounded" />
                        <p class="danger bg-red-500 py-1 px-2 rounded-2 text-white my-2" id="dateStartEditError" style="display: none"></p>
                        <p class="mt-3">Date End</p>
                        <input type="datetime-local" name="dateEnd" id="dateEndEdit" class="w-full rounded" />
                        <p class="danger bg-red-500 py-1 px-2 rounded-2 text-white my-2" id="dateEndEditError" style="display: none"></p>
                        <input hidden readonly id="EditId" />
                        <p class="mt-3">Status</p>
                        <select class="w-full rounded" id="statusEdit">
                            <option value="Pending">Pending</option>
                            <option value="Accepted">Accepted</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                        <p class="mt-3">Event</p>
                        <input type="text" name="event" id="eventEdit" class="w-full rounded" />
                        <p class="danger bg-red-500 py-1 px-2 rounded-2 text-white my-2" id="eventEditError" style="display: none"></p>
                    </div>
                </div>
                <div class="flex items-center justify-between bg-gray-50">
                    <button type="button" class=" float-left inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm" onclick="deleteHandler()">Delete</button>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm" onclick="updateHandler()">Update</button>
                        <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="modalEditHandler()">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('JS')
<script src="{{ url('/') }}/assets/js/jquery.toaster.js"></script>
<script src="{{ url('/') }}/assets/js/cute-alert.js"></script>
<script src="{{ url('/') }}/assets/js/custom.js"></script>
<script src="{{ url('/') }}/assets/js/index.global.min.js"></script>
<script src="{{ url('/') }}/assets/js/popper.min.js"></script>
<script src="{{ url('/') }}/assets/js/tippy-bundle.umd.min.js"></script>
<script>
    function datetimeLocal(datetime) {
        const dt = new Date(datetime);
        dt.setMinutes(dt.getMinutes() - dt.getTimezoneOffset());
        return dt.toISOString().slice(0, 16);
    }
    let modal = false;
    const modalHandler = () => {
        const modalElement = document.getElementById('modal');
        modal = !modal;
        if (modal) {
            modalElement.style.display = 'block'
        } else {
            modalElement.style.display = 'none'
        }
    }
    let modalEdit = false;
    const modalEditHandler = (id) => {
        modalEdit = !modalEdit;
        const modalElement = document.getElementById('modal_Edit');
        let select = document.getElementById('employeeEdit');
        select.value = id;
        if (modalEdit) {
            modalElement.style.display = 'block'
        } else {
            modalElement.style.display = 'none'
        }
    }
    const calanderHandler = (eventsArray) => {
        var calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            eventDidMount: function(info) {
                tippy(info.el, {
                    theme: 'CUSTOM',
                    content: info.event.extendedProps.name,
                });
            },

            eventClick: function(info) {
                document.getElementById('dateStartEdit').value = datetimeLocal(info.event.start);
                document.getElementById('dateEndEdit').value = datetimeLocal(info.event.end);
                document.getElementById('eventEdit').value = info.event.title;
                document.getElementById('EditId').value = info.event.extendedProps.editId;
                document.getElementById('statusEdit').value = info.event.extendedProps.status;
                modalEditHandler(info.event.extendedProps.userId)
            },
            events: eventsArray,
            views: {
                list: {
                    duration: null,
                    buttonText: 'All Events',
                }
            },
            eventContent: function(info) {
                let event = info.event;
                console.log(event)
                let extraInfoEl = document.createElement('div');
                extraInfoEl.classList.add('extra-info');

                const created_at = event.extendedProps.created_at;
                const start_date = event.start;
                const ended_date = event.end;

                const date = new Date(created_at);
                const dateStart = new Date(start_date);
                let createdAtEl = document.createElement('p');
                createdAtEl.classList.add('created-at');
                const start =  dateStart.getFullYear() + '-' + (dateStart.getMonth() + 1).toString().padStart(2, '0') + '-' + dateStart.getDate().toString().padStart(2, '0');
                createdAtEl.innerText = 'Start Date: ' + start;

               //ended at
                const dateEnd = new Date(ended_date);
                let endedAtEl = document.createElement('p');
                endedAtEl.classList.add('ended-at');
                const end =  dateEnd.getFullYear() + '-' + (dateEnd.getMonth() + 1).toString().padStart(2, '0') + '-' + dateEnd.getDate().toString().padStart(2, '0');
                endedAtEl.innerText = 'End date: ' + end;

                let employeeName = document.createElement('p');
                employeeName.classList.add('employee-name');
                employeeName.innerText = 'Employee Name: '
                //add span inside p
                let span = document.createElement('span');
                span.innerText = event.extendedProps.name;
                employeeName.appendChild(span);
                span.style.color = event.extendedProps.customColor;
                span.style.fontWeight = 'bold';
                span.style.border = '1px solid';
                span.style.textTransform = 'capitalize';



                let statusEl = document.createElement('p');
                statusEl.classList.add('status');
                let colorStatus = document.createElement('span');
                if (event.extendedProps.status === 'Pending') {
                    colorStatus.style.color = 'yellow'
                } else if (event.extendedProps.status === 'Rejected') {
                    colorStatus.style.color = '#ff3333'
                } else if (event.extendedProps.status === 'Accepted') {
                    colorStatus.style.color = '#00ffb0'
                }
                colorStatus.innerText = event.extendedProps.status;

                statusEl.innerHTML = 'Status: ';
                statusEl.appendChild(colorStatus);

                extraInfoEl.appendChild(createdAtEl);
                extraInfoEl.appendChild(endedAtEl);
                extraInfoEl.appendChild(statusEl);
                extraInfoEl.appendChild(employeeName);


                let titleEl = document.createElement('div');
                titleEl.classList.add('fc-title');
                titleEl.innerText = event.title;

                let contentEl = document.createElement('div');
                contentEl.classList.add('fc-content');
                contentEl.appendChild(titleEl);
                contentEl.appendChild(extraInfoEl);
                contentEl.style.backgroundColor = event.backgroundColor;
                contentEl.style.color = 'white';
                contentEl.style.border = '1px solid blue';
                contentEl.style.borderRadius = '2px';



                return {
                    domNodes: [contentEl]
                };
            },
            viewDidMount: function(viewInfo) {
                if (viewInfo.view.type === 'list') {
                    const title = document.getElementsByClassName('fc-toolbar-title');
                    title[0].innerText = ''
                }
            },
            visibleRange: function(currentDate) {
                let start = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate());
                let end = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate() + 3653);
                return {
                    start: start,
                    end: end
                };
            },
            customButtons: {
                myCustomButton: {
                    text: 'Add Holiday',
                    click: function() {
                        modalHandler()
                    }
                }
            },
            headerToolbar: {
                left: 'dayGridMonth,timeGridWeek,timeGridDay,list',
                center: 'title',
                right: 'prev,next today myCustomButton'
            },

        });

        calendar.render();
    }
    $.ajax({
        type: "Get",
        url: "{{ route('admin.getHoliday') }}",
        data: "data",
        success: function(response) {
            calanderHandler(response);
        },
        error: function(error) {
            console.log(error);
        }
    });

</script>
<script>
    @if(session('message'))
    $.toaster('{{ session('
        message ') }}', '', 'danger bg-green-500 py-3 px-2 rounded-2 text-white');
    @endif
    @if(session('error'))
    $.toaster('{{ session('
        message ') }}', '', 'danger bg-red-500 py-3 px-2 rounded-2 text-white');
    @endif

    const submitHandler = () => {
        let employee = document.getElementById('employee');
        let dateStart = document.getElementById('dateStart');
        let dateEnd = document.getElementById('dateEnd');
        let statusCreate = document.getElementById('statusCreate');
        let event = document.getElementById('event');
        const token = document.querySelector("[name='csrf-token']").getAttribute('content');
        const dateStartError = document.getElementById('dateStartError');
        const dateEndError = document.getElementById('dateEndError');
        const eventError = document.getElementById('eventError');
        $.ajax({
            type: "post",
            url: "{{ route('admin.addholiday') }}",
            data: {
                employee: employee.value,
                datestart: dateStart.value,
                dateend: dateEnd.value,
                event: event.value,
                statusCreate: statusCreate.value,
                _token: token
            },
            success: function(response) {
                if(response.error){
                    $.toaster(response.error, '', 'danger bg-red-500 py-3 px-2 rounded-2 text-white mb-2');
                    return;
                }
                dateStartError.style.display = 'none';
                dateEndError.style.display = 'none';
                eventError.style.display = 'none';
                employee.value = '';
                dateStart.value = '';
                dateEnd.value = '';
                event.value = '';
                statusCreate.value = '';
                modalHandler()
                calanderHandler(response)
            },
            error: function(error) {
                if (error.responseJSON.errors.employee) {
                    $.toaster('Employee Field is Required', '', 'danger bg-red-500 py-3 px-2 rounded-2 text-white mb-2');
                }
                if (error.responseJSON.errors.datestart) {
                    $.toaster('Date Start Field is Required', '', 'danger bg-red-500 py-3 px-2 rounded-2 text-white mb-2');
                    dateStartError.style.display = 'block';
                    dateStartError.textContent = 'Date Start Field is Required';
                }
                if (error.responseJSON.errors.dateend) {
                    $.toaster('Date End Field is Required', '', 'danger bg-red-500 py-3 px-2 rounded-2 text-white mb-2');
                    dateEndError.style.display = 'block';
                    dateEndError.textContent = 'Date End Field is Required';
                }
                if (error.responseJSON.errors.event) {
                    $.toaster('Event Field is Required', '', 'danger bg-red-500 py-3 px-2 rounded-2 text-white mb-2');
                    eventError.style.display = 'block';
                    eventError.textContent = 'Event Field is Required';
                }
            },
        });

    }

    const updateHandler = () => {
        let edit = document.getElementById('EditId').value;
        let employee = document.getElementById('employeeEdit').value;
        let dateStart = document.getElementById('dateStartEdit').value;
        let dateEnd = document.getElementById('dateEndEdit').value;
        let event = document.getElementById('eventEdit').value;
        let statusEdit = document.getElementById('statusEdit').value;
        const token = document.querySelector("[name='csrf-token']").getAttribute('content');
        const dateStartError = document.getElementById('dateStartEditError');
        const dateEndError = document.getElementById('dateEndEditError');
        const eventError = document.getElementById('eventEditError');
        $.ajax({
            type: "post",
            url: "{{ route('admin.updateHoliday') }}",
            data: {
                edit: edit,
                employee: employee,
                datestart: dateStart,
                dateend: dateEnd,
                event: event,
                status: statusEdit,
                _token: token
            },
            success: function(response) {
                  if(response.error){
                    $.toaster(response.error, '', 'danger bg-red-500 py-3 px-2 rounded-2 text-white mb-2');
                    return;
                    }
                dateStartError.style.display = 'none';
                dateEndError.style.display = 'none';
                eventError.style.display = 'none';
                edit = ''
                employee = ''
                dateStart = ''
                dateEnd = ''
                event = ''
                modalEditHandler()
                calanderHandler(response)
            },
            error: function(error) {

                if (error.responseJSON.errors.employee) {
                    $.toaster('Employee Field is Required', '', 'danger bg-red-500 py-3 px-2 rounded-2 text-white mb-2');
                }
                if (error.responseJSON.errors.datestart) {
                    $.toaster('Date Start Field is Required', '', 'danger bg-red-500 py-3 px-2 rounded-2 text-white mb-2');
                    dateStartError.style.display = 'block';
                    dateStartError.textContent = 'Date Start Field is Required';
                }
                if (error.responseJSON.errors.dateend) {
                    $.toaster('Date End Field is Required', '', 'danger bg-red-500 py-3 px-2 rounded-2 text-white mb-2');
                    dateEndError.style.display = 'block';
                    dateEndError.textContent = 'Date End Field is Required';
                }
                if (error.responseJSON.errors.event) {
                    $.toaster('Event Field is Required', '', 'danger bg-red-500 py-3 px-2 rounded-2 text-white mb-2');
                    eventError.style.display = 'block';
                    eventError.textContent = 'Event Field is Required';
                }
            },
        });
    }
    const deleteHandler = () => {
        let edit = document.getElementById('EditId').value;
        let token = document.querySelector("[name='csrf-token']").getAttribute('content');
        $.ajax({
            type: "post",
            url: "{{ route('admin.deleteholiday') }}",
            data: {
                edit: edit,
                _token: token
            },
            success: function(response) {
                edit = ''
                modalEditHandler();
                calanderHandler(response);
                $.toaster('Event Delete Successfully', '', 'danger bg-green-500 py-3 px-2 rounded-2 text-white');
            },
            error: function(error) {
                console.log(error);
            },
        });
    }
</script>
<script>
    const dateStart = document.getElementById('dateStart');
    const dateEnd = document.getElementById('dateEnd');
    dateStart.addEventListener('change', () => {
        dateEnd.min = dateStart.value;
    })
    dateEnd.addEventListener('change', () => {
        dateStart.max = dateEnd.value;
    })
</script>

@endsection
