<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table table-bordered table-hover" id="profileDatatable"
                           style="width: 100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Budget</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <x-slot name="additionalScripts">
        <script>
            $('#profileDatatable').DataTable({
                processing: true,
                serverSide: true, ordering: false,
                ajax: '{{route('customer-data.ajax')}}',
                columns: [
                    {data: 'name', name: 'name', orderable: false, searchable: false},
                    {data: 'email', name: 'email', orderable: false, searchable: false},
                    {data: 'phone', name: 'phone', orderable: false, searchable: false},
                    {data: 'budget', name: 'budget', orderable: false, searchable: false},
                    {data: 'message', name: 'message', orderable: false, searchable: false},

                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
            function createAccount(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, create it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{route('customer.create.wp')}}",
                            type: 'post',
                            data: {
                                id: id,
                                _token: '{{csrf_token()}}',
                            },
                            success: function (data) {
                                console.log(data);
                                Swal.fire(
                                    'Success!',
                                    data.message,
                                    'success'
                                )
                                $('#profileDatatable').DataTable().ajax.reload();
                            },
                            error: function (data) {
                                Swal.fire(
                                    'Error!',
                                    data.responseJSON.message,
                                    'error'
                                )
                            }
                        });
                    } else {
                        Swal.fire('Cancelled', 'Operation Cancelled', 'error');
                    }
                });
            }
        </script>
    </x-slot>
</x-app-layout>

