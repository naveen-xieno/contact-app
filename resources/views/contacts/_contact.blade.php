{{-- <tr @if ($loop->even) class="table-primary" @endif> 
    <th scope="row">1</th>
    <td>{{$contact['name'] }}</td>
    <td>{{$contact['phone'] }}</td>
    <td>alfred@test.com</td>
    <td>Company one</td>
    <td width="150">
    <a href="{{ route('contacts.show', $id)  }}" class="btn btn-sm btn-circle btn-outline-info" title="Show"><i class="fa fa-eye"></i></a>
    <a href="form.html" class="btn btn-sm btn-circle btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>
    <a href="#" class="btn btn-sm btn-circle btn-outline-danger" title="Delete" onclick="confirm('Are you sure?')"><i class="fa fa-times"></i></a>
    </td>
</tr> --}}

<tr @if ($loop->even) class="table-primary" @endif> 
    <th scope="row">{{ $contacts->firstItem() + $index }}</th>
    <td>{{$contact->first_name }}</td>
    <td>{{$contact->last_name }}</td>
    <td>{{$contact->phone }}</td>
    <td>{{$contact->email }}</td>
    {{-- <td>{{$contact->company_id }}</td> --}}

    {{-- Laravel Helper Function to show variable if its avaialable 
    <td>{{ optional($contact->company)->name }}</td> --}}

    <td>{{ $contact->company->name }}</td>

    <td width="150">
        @if ($showTrashButtons)
        {{-- <form action="{{ route('contacts.restore', $contact->id) }}" method="POST" style="display: inline">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-sm btn-circle btn-outline-info" title="Restore">
                <i class="fa fa-undo"></i>
            </button>
        </form>
        
        <form action="{{ route('contacts.force-delete', $contact->id) }}" method="POST" onsubmit="return confirm('Your data will be removed permanently. Are you sure?');" style="display: inline">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-sm btn-circle btn-outline-danger" title="Delete permanently">
                <i class="fa fa-times"></i>
            </button>
        </form> --}}

        @include('shared.buttons.restore', ['action' => route('contacts.restore', $contact->id)])

        @include('shared.buttons.force-delete', ['action' => route('contacts.force-delete', $contact->id)])

        @else

        <a href="{{ route('contacts.show', $contact->id)  }}" class="btn btn-sm btn-circle btn-outline-info" title="Show"><i class="fa fa-eye"></i></a>
        <a href="{{ route('contacts.edit', $contact->id)  }}" class="btn btn-sm btn-circle btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>
        {{-- <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline"> --}}
        {{-- <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display: inline">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-sm btn-circle btn-outline-danger" title="Trash">
                <i class="fa fa-trash"></i>
            </button>
        </form> --}}

        @include('shared.buttons.destroy', ['action' => route('contacts.destroy', $contact->id)])

        @endif
    </td>
</tr>