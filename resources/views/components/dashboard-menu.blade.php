@props(['menuItems' => []])

<div class="row">
    @foreach ($menuItems as $item)
        <div class="col-md-4 mb-3">
            <a href="{{ $item['route'] }}" class="btn btn-primary w-100" style="height: 100px; display: flex; align-items: center; justify-content: center;">
                <i class="{{ $item['icon'] }}" style="margin-right: 10px;"></i> {{ $item['title'] }}
            </a>
        </div>
    @endforeach
</div> 