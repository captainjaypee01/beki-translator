<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">  
            <tr>
                <th>Word Name</th>
                <td>{{ $word->name }}</td>
            </tr>  
            <tr>
                <th>Description</th>
                <td>{{ $word->description }}</td>
            </tr>
 
 
            <tr>
                <th>Last Updated At</th>
                <td>
                    @if($word->updated_at)
                        {{ timezone()->convertToLocal($word->updated_at) }}
                    @else
                        N/A
                    @endif
                </td>
            </tr>
 
        </table>
    </div>
</div><!--table-responsive-->
