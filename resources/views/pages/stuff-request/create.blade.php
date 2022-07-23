@extends('layouts.app')
@section('title', 'Request List')
@section('content')
    <h1 class="mb-5">Add Request</h1>
    <form method="POST" action="{{ route('stuffs.requests.store') }}">
        @csrf
        <div class="row mb-5">
            <div class="col-4">
                <label for="receiver-nik" class="form-label">NIK</label>
                <select class="form-control" id="receiver-nik" name="receiver_id">
                    
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}"> {{ $user->nik }} </option>
                    @endforeach

                </select>
            </div>
            <div class="col-4">
                <label for="receiver-name" class="form-label">Name</label>
                <input type="text" class="form-control" id="receiver-name" readonly>
            </div>
            <div class="col-4">
                <label for="receiver-departement" class="form-label">Departement</label>
                <input type="text" class="form-control" id="receiver-departement" readonly>
            </div>
        </div>

        <div class="row mb-4">
            <div class="mb-1 d-flex">
                <h2 class="fs-5">Item List</h2>
                <button id="stuff-add-item" class="d-block ms-auto btn btn-success" type="button">Add Item</button>
            </div>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Location</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="stuff-list">
                    <tr id="stuff-1" class="stuff">
                        <th class="stuff-number align-middle" scope="row">1</th>
                        <td class="align-middle">
                            <select class="stuff-id form-control" name="stuffs[0][id]" style="width: 16rem">
                                
                                @foreach ($stuffs as $stuff)
                                <option value="{{ $stuff->id }}"> {{ $stuff->code }} | {{ $stuff->name }} </option>
                                @endforeach

                            </select>
                        </td>
                        <td class="align-middle"><input type="text" class="stuff-location form-control" readonly></td>
                        <td class="align-middle"><input type="number" class="stuff-stock form-control" readonly></td>
                        <td class="align-middle"><input type="number" class="stuff-quantity form-control" name="stuffs[0][quantity]" value="1"></td>
                        <td class="align-middle"><input type="text" class="stuff-unit form-control" readonly></td>
                        <td class="align-middle"><input type="text" class="stuff-description form-control" name="stuffs[0][description]"></td>
                        <td class="align-middle"><input type="text" class="stuff-status form-control" readonly></td>
                        <td class="align-middle"><button type="button" class="stuff-delete-button btn btn-danger" data-id="stuff-1">x</button></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <button id="form-sumit" type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
@section('scripts')
    <script>
        const users  = @json($users);
        const stuffs = @json($stuffs);

        // QUERY SELECTOR HELPER
        const $ = {
            all: (query, elmnt) => elmnt ? elmnt.querySelectorAll(query) : document.querySelectorAll(query),
            first: (query, elmnt) => elmnt ? elmnt.querySelector(query) : document.querySelector(query),
        };
        
        // EKEMENTS
        const elmnts = {
            button: {
                submit: () => $.first('#form-submit'),
                addStuff: () => $.first('#stuff-add-item'),
            },
            receiver: {
                nik: () => $.first('#receiver-nik'),
                name: () => $.first('#receiver-name'),
                departement: () => $.first('#receiver-departement'),
            },
            stuff: () => $.first('.stuff'),
            stuffs: () => $.all('.stuff'),
            stuffList: ()=> $.first('#stuff-list'),
        }

        // UPDATE RECEIVER DATA HANDLER
        const updateReceiver = () => {
            const user = users.find(item => item.id == elmnts.receiver.nik().value);
            elmnts.receiver.name().value = user.name;
            elmnts.receiver.departement().value = user.departement.name;
        }

        // UPDATE ALL STUFFS HANDLER
        const updateStuffs = () => {
            elmnts.stuffs().forEach((item, index) => {
                const elmnt   = {
                    id: $.first('.stuff-id', item),
                    unit: $.first('.stuff-unit', item),
                    stock: $.first('.stuff-stock', item),
                    status: $.first('.stuff-status', item),
                    number: $.first('.stuff-number', item),
                    location: $.first('.stuff-location', item),
                    quantity: $.first('.stuff-quantity', item),
                    description: $.first('.stuff-description', item),
                    deleteButton: $.first('.stuff-delete-button', item),
                };

                const stuff             = stuffs.find(item => item.id == elmnt.id.value);
                elmnt.number.innerText  = index+1;
                elmnt.stock.value       = stuff.stock;
                elmnt.unit.value        = stuff.unit_name;
                elmnt.location.value    = stuff.location.code;
                elmnt.id.name           = `stuffs[${index}][id]`;
                elmnt.quantity.name     = `stuffs[${index}][quantity]`;
                elmnt.description.name  = `stuffs[${index}][description]`;

                if(stuff.stock >= elmnt.quantity.value) elmnt.status.value = 'Available';
                else elmnt.status.value = 'Inavailable';
                
                elmnt.id.addEventListener('change', updateStuffs, {once: true});
                elmnt.quantity.addEventListener('change', updateStuffs, {once: true});
            });
        }

        // ADD STUFF HANDLER
        const addStuff = () => {
            const stuffElmnts   = elmnts.stuffs();
            const prevElmnt     = stuffElmnts[stuffElmnts.length - 1];
            const elmnt         = document.createElement('tr');
            const id            = `stuff-${Number(prevElmnt.id.split('-')[1]) + 1}`;
            elmnt.id            = id;
            elmnt.innerHTML     = prevElmnt.innerHTML;
            elmnt.classList.add('stuff');

            const deleteButton  = $.first('.stuff-delete-button', elmnt);
            deleteButton.dataset.id = id;
            deleteButton.addEventListener('click', () => deleteStuff(elmnt));

            elmnts.stuffList().appendChild(elmnt);
            updateStuffs();
        }

        // DELETE STUFF HANDLER
        const deleteStuff = (item) => {
            if(elmnts.stuffs().length == 1) return alert('Must be at least 1 item');
            item.remove();
            updateStuffs();
        }

        // INIT STUFF DELETE BUTTONS
        const initStuffDeleteButtons = () => {
            elmnts.stuffs().forEach(item => {
                const deleteButton  = $.first('.stuff-delete-button', item);
                deleteButton.addEventListener('click', () => deleteStuff(item));
            });
        }


        // EVENT LISTENERS
        document.addEventListener('DOMContentLoaded', () => {
            updateReceiver();
            updateStuffs();
            initStuffDeleteButtons();
        });

        elmnts.receiver.nik().addEventListener('change', updateReceiver);
        elmnts.button.addStuff().addEventListener('click', addStuff);
    </script>
@endsection