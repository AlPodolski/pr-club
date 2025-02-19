@extends('layouts.app')

@section('title', 'Чат')

@section('content')

    @include('admin.include.nav')

    <main class=" chat admin-chat">
        @include('new.cabinet.include.message')

        <div class="chat__list">

            @foreach($chatList as $chatItem)

                @if($chatItem->last and $chatItem->last->status == \App\Models\ChatMessage::NOT_READ_STATUS
                    and $chatItem->last->from <> 0 and $chatItem->last->created_at > \Carbon\Carbon::now()->subDays(14))

                    <div class="chat__list-item" data-id="{{ $chatItem->chat_id }}" onclick="getChat(this)">
                        <div class="chat__list-item-name">
                            {{ $chatItem->user->name }}
                        </div>

                        <div
                            class="message-text @if($chatItem->last->status == \App\Models\ChatMessage::NOT_READ_STATUS) not-read @endif ">

                            @if($chatItem->last->related_class == \App\Models\File::class)
                                <svg>
                                    <use xlink:href='/svg/dest/stack/cabinet.svg#addFile'></use>
                                </svg>
                            @else
                                {{ $chatItem->last->message }}
                            @endif
                        </div>

                    </div>

                @endif

            @endforeach

            @foreach($chatList as $chatItem)

                @if($chatItem->last and $chatItem->last->created_at > \Carbon\Carbon::now()->subDays(14))

                    <div class="chat__list-item" data-id="{{ $chatItem->chat_id }}" onclick="getChat(this)">
                        <div class="chat__list-item-name">
                            {{ $chatItem->user->name }}
                        </div>

                        <div
                            class="message-text @if(isset($chatItem->last->status ) and $chatItem->last->status == \App\Models\ChatMessage::NOT_READ_STATUS and $chatItem->last->from <> 0) not-read @endif ">
                            @if($chatItem->last->related_class == \App\Models\File::class)
                                <svg>
                                    <use xlink:href='/svg/dest/stack/cabinet.svg#addFile'></use>
                                </svg>
                            @else
                                {{ $chatItem->last->message }}
                            @endif
                        </div>

                    </div>
                @endif

            @endforeach

        </div>

        <div class="chat__dialog">

        </div>
    </main>

@endsection
