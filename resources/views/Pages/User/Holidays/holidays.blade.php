@extends('layouts.app')
@section('CSS')
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/cute.css">
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
                    <p class="mt-3">Date Start</p>
                    <input type="datetime-local" name="dateStart" id="dateStart" class="w-full rounded"/>
                    <p class="danger bg-red-500 py-1 px-2 rounded-2 text-white my-2" id="dateStartError" style="display: none"></p>
                    <p class="mt-3">Date End</p>
                    <input type="datetime-local" name="dateEnd" id="dateEnd" class="w-full rounded"/>
                    <p class="danger bg-red-500 py-1 px-2 rounded-2 text-white my-2" id="dateEndError" style="display: none"></p>
                    <p class="mt-3">Event</p>
                    <input type="text" name="event" id="event" class="w-full rounded"/>
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
    <div class="relative z-990" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="modalEdit" style="display: none">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 dark:bg-black dark:bg-opacity-50 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
          <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
              <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="text-center border-b">
                    <p class="text-black font-bold text-5">Edit Holiday</p>
                </div>
                <div class="text-left mt-5">
                    <p class="mt-3">Date Start</p>
                    <input type="datetime-local" name="dateStart" id="dateStartEdit" class="w-full rounded"/>
                    <p class="danger bg-red-500 py-1 px-2 rounded-2 text-white my-2" id="dateStartEditError" style="display: none"></p>
                    <p class="mt-3">Date End</p>
                    <input type="datetime-local" name="dateEnd" id="dateEndEdit" class="w-full rounded"/>
                    <p class="danger bg-red-500 py-1 px-2 rounded-2 text-white my-2" id="dateEndEditError" style="display: none"></p>
                    <p class="mt-3">Event</p>
                    <input hidden readonly id="EditId"/>
                    <input type="text" name="event" id="eventEdit" class="w-full rounded"/>
                    <p class="danger bg-red-500 py-1 px-2 rounded-2 text-white my-2" id="eventEditError" style="display: none"></p>
                </div>
              </div>
              <div class="flex items-center justify-between bg-gray-50">
                  <button type="button" class=" float-left inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm" onclick="deleteHandler()">Delete</button>
                  <div class=" px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm" onclick="updateHandler()">Submit</button>
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
            }
            else{
                modalElement.style.display = 'none'
            }
        }
        let modalEdit = false;
        const modalEditHandler = (id) => {
            modalEdit = !modalEdit;
            const modalElement = document.getElementById('modalEdit');
            if (modalEdit) {
                modalElement.style.display = 'block'
            }
            else{
                modalElement.style.display = 'none'
            }
        }
        const calanderHandler = (eventsArray) => {
          var calendarEl = document.getElementById('calendar');
          var calendar = new FullCalendar.Calendar(calendarEl, {
            eventDidMount: function(info) {
                tippy(info.el, {
                    theme: 'CUSTOM',
                    content: info.event.extendedProps.name,
                });
            },
            eventClick: function(info) {
                if (info.event.extendedProps.userId == {{ Auth::user()->id }}) {
                    document.getElementById('dateStartEdit').value = datetimeLocal(info.event.start);
                    document.getElementById('dateEndEdit').value = datetimeLocal(info.event.end);
                    document.getElementById('eventEdit').value = info.event.title;
                    document.getElementById('EditId').value = info.event.extendedProps.editId;
                    modalEditHandler(info.event.extendedProps.userId)
                }
            },
            events: eventsArray,
            customButtons: {
                myCustomButton: {
                text: 'Add Holiday',
                    click: function() {
                        modalHandler()
                    }
                }
            },
            headerToolbar: {
                left: 'dayGridMonth,timeGridWeek,timeGridDay',
                center: 'title',
                right: 'prev,next today myCustomButton'
            }
          });

          calendar.render();

        };

        $.ajax({
            type: "Get",
            url: "{{ route('user.getHoliday') }}",
            data: "data",
            success: function (response) {
                calanderHandler(response);
            },
            error: function (error) {
                console.log(error);
            }
        });
      </script>
    <script>

        @if (session('message'))
            $.toaster('{{ session('message') }}', '', 'danger bg-green-500 py-3 px-2 rounded-2 text-white');
        @endif
        @if (session('error'))
            $.toaster('{{ session('message') }}', '', 'danger bg-red-500 py-3 px-2 rounded-2 text-white');
        @endif

        const submitHandler = () => {
            let dateStart = document.getElementById('dateStart').value;
            let dateEnd = document.getElementById('dateEnd').value;
            let event = document.getElementById('event').value;
            let token = document.querySelector("[name='csrf-token']").getAttribute('content');
            let dateStartError = document.getElementById('dateStartError');
            let dateEndError = document.getElementById('dateEndError');
            let eventError = document.getElementById('eventError');
            $.ajax({
                type: "post",
                url: "{{ route('user.addholiday') }}",
                data: {
                    datestart: dateStart,
                    dateend: dateEnd,
                    event: event,
                    _token: token
                },
                success: function (response) {
                    dateStartError.style.display = 'none';
                    dateEndError.style.display = 'none';
                    eventError.style.display = 'none';
                    dateStart = ''
                    dateEnd = ''
                    event = ''
                    modalHandler()
                    calanderHandler(response);
                },
                error: function (error) {

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
            let dateStart = document.getElementById('dateStartEdit').value;
            let dateEnd = document.getElementById('dateEndEdit').value;
            let event = document.getElementById('eventEdit').value;
            let token = document.querySelector("[name='csrf-token']").getAttribute('content');
            let dateStartError = document.getElementById('dateStartEditError');
            let dateEndError = document.getElementById('dateEndEditError');
            let eventError = document.getElementById('eventEditError');
            $.ajax({
                type: "post",
                url: "{{ route('user.updateholiday') }}",
                data: {
                    edit: edit,
                    datestart: dateStart,
                    dateend: dateEnd,
                    event: event,
                    _token: token
                },
                success: function (response) {
                    console.log(response);
                    dateStartError.style.display = 'none';
                    dateEndError.style.display = 'none';
                    eventError.style.display = 'none';
                    edit = ''
                    dateStart = ''
                    dateEnd = ''
                    event = ''
                    modalEditHandler()
                    calanderHandler(response);
                },
                error: function (error) {

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
                url: "{{ route('user.deleteholiday') }}",
                data: {
                    edit: edit,
                    _token: token
                },
                success: function (response) {
                    edit = ''
                    modalEditHandler();
                    $.toaster('Event Delete Successfully', '', 'danger bg-green-500 py-3 px-2 rounded-2 text-white');
                    calanderHandler(response);
                },
                error: function (error) {
                    console.log(error);
                },
            });
        }
    </script>
@endsection
