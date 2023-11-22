<div class="card">
    <div class="card-body" style="display: flex; align-items: center;">
        <div style="flex: 1;">
            <h5 class="card-title">{{ $taxi->original->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $taxi->price }} руб.</h6>
        </div>
        <div class="color-display" style="width: 60px; height: 60px; border: 1px solid black; background-color:
            @if($taxi->color === 1)
                red
            @elseif($taxi->color === 2)
                blue
            @elseif($taxi->color === 3)
                yellow
            @else
                white
            @endif
        "></div>
        <form action="{{ route('userTaxi.change', ['userTaxi' => $taxi->id]) }}" method="POST" style="margin-left: 10px;">
            @csrf
            <input type="hidden" name="taxi_id" value="{{ $taxi->id }}">
            <button type="submit" class="btn btn-primary">Сменить цвет</button>
        </form>
    </div>
</div>
