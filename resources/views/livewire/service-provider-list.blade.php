<div>
    @if ($serviceProviders->count())
        <ul class="divide-y divide-gray-200">
            @foreach ($serviceProviders as $provider)
                <li class="py-2">{{ $provider->company_name }}</li>
            @endforeach
        </ul>
        <div class="mt-4">
            {{ $serviceProviders->links() }}
        </div>
    @else
        <p>Aucun prestataire trouvé.</p>
    @endif
</div>
