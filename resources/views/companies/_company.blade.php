<tr @if ($loop->even) class="table-primary" @endif> 
    <th scope="row">{{ $companies->firstItem() + $index }}</th>
    <td>{{$company->name }}</td>
    <td>{{$company->website }}</td>
    <td>{{$company->email }}</td>
    <td><a href="{{ route('contacts.index', ['company_id' => $company->id])}}">{{ $company->contacts->count() }}</a></td>

    <td width="150">
        @if ($showTrashButtons)

        @include('shared.buttons.restore', ['action' => route('companies.restore', $company->id)])
        {{-- <form action="{{ route('companies.restore', $company->id) }}" method="POST" style="display: inline">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-sm btn-circle btn-outline-info" title="Restore">
                <i class="fa fa-undo"></i>
            </button>
        </form> --}}
        
        @include('shared.buttons.force-delete', ['action' => route('companies.force-delete', $company->id)])
        {{-- <form action="{{ route('companies.force-delete', $company->id) }}" method="POST" onsubmit="return confirm('Your data will be removed permanently. Are you sure?');" style="display: inline">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-sm btn-circle btn-outline-danger" title="Delete permanently">
                <i class="fa fa-times"></i>
            </button>
        </form> --}}

        @else

        <a href="{{ route('companies.show', $company->id)  }}" class="btn btn-sm btn-circle btn-outline-info" title="Show"><i class="fa fa-eye"></i></a>
        <a href="{{ route('companies.edit', $company->id)  }}" class="btn btn-sm btn-circle btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>

        @include('shared.buttons.destroy', ['action' => route('companies.destroy', $company->id)])
        {{-- <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display: inline">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-sm btn-circle btn-outline-danger" title="Trash">
                <i class="fa fa-trash"></i>
            </button>
        </form> --}}
        @endif
    </td>
</tr>