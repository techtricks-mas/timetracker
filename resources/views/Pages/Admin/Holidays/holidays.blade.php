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
                    <p>Select Employee</p>
                    <select class="w-full rounded" name="employee" id="employee">
                        <option value="">Select Employee</option>
                        @foreach ($employess as $employee)
                            <option value="{{ $employee->user_id }}">{{ $employee->fname }} {{ $employee->lname }}</option>
                        @endforeach
                    </select>
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
@endsection
@section('JS')
    <script src="{{ url('/') }}/assets/js/jquery.toaster.js"></script>
    <script src="{{ url('/') }}/assets/js/cute-alert.js"></script>
    <script src="{{ url('/') }}/assets/js/custom.js"></script>
    <script src="{{ url('/') }}/assets/js/index.global.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script>
        let data = {!! json_encode($data) !!};
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
        document.addEventListener('DOMContentLoaded', function() {
          var calendarEl = document.getElementById('calendar');
          var calendar = new FullCalendar.Calendar(calendarEl, {
            eventDidMount: function(info) {
                tippy(info.el, {
                    theme: 'CUSTOM',
                    content: info.event.extendedProps.name,
                });
            },
            events: data,
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
            const employee = document.getElementById('employee').value;
            const dateStart = document.getElementById('dateStart').value;
            const dateEnd = document.getElementById('dateEnd').value;
            const event = document.getElementById('event').value;
            const token = document.querySelector("[name='csrf-token']").getAttribute('content');
            const dateStartError = document.getElementById('dateStartError');
            const dateEndError = document.getElementById('dateEndError');
            const eventError = document.getElementById('eventError');
            $.ajax({
                type: "post",
                url: "{{ route('admin.addholiday') }}",
                data: {
                    employee: employee,
                    datestart: dateStart,
                    dateend: dateEnd,
                    event: event,
                    _token: token
                },
                success: function (response) {
                    dateStartError.style.display = 'none';
                    dateEndError.style.display = 'none';
                    eventError.style.display = 'none';
                    modalHandler()
                    location.reload();
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
                    console.log(error.responseJSON);
                },
            });
        }
    </script>
@endsection
