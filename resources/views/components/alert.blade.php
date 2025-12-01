@if(session('success'))
    <div class="p-4 mb-4 text-green-800 bg-green-100 border border-green-200 rounded-md">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="p-4 mb-4 text-red-800 bg-red-100 border border-red-200 rounded-md">
        {{ session('error') }}
    </div>
@endif

@if(session('warning'))
    <div class="p-4 mb-4 text-yellow-800 bg-yellow-100 border border-yellow-200 rounded-md">
        {{ session('warning') }}
    </div>
@endif

@if(session('info'))
    <div class="p-4 mb-4 text-blue-800 bg-blue-100 border border-blue-200 rounded-md">
        {{ session('info') }}
    </div>
@endif

@if($errors->any())
    <div class="p-4 mb-4 text-red-800 bg-red-100 border border-red-200 rounded-md">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif