<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\SupportRequest;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SupportRequestResource\Pages;
use App\Filament\Resources\SupportRequestResource\RelationManagers;
use App\Filament\Resources\SupportRequestResource\Pages\EditSupportRequest;
use App\Filament\Resources\SupportRequestResource\Pages\ListSupportRequests;
use App\Filament\Resources\SupportRequestResource\Pages\CreateSupportRequest;

class SupportRequestResource extends Resource
{
    protected static ?string $model = SupportRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Support Request')
                ->description('Send all complaints to our dedicated support team.')
                ->schema([
                TextInput::make('name')->rules('min:3|max:50')->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('subject')->required(),
                MarkdownEditor::make('details')->rules('min:3|max:300')->required()->columnSpanFull(),
                ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->sortable()
                ->searchable()
                ->toggleable(),

                TextColumn::make('email')
                ->sortable()
                ->searchable()
                ->toggleable(),

                TextColumn::make('subject')
                ->sortable()
                ->searchable()
                ->toggleable(),

                TextColumn::make('details')
                ->toggleable(),

                TextColumn::make('created_at')
                ->sortable()
                ->searchable()
                ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSupportRequests::route('/'),
            'create' => Pages\CreateSupportRequest::route('/create'),
            'edit' => Pages\EditSupportRequest::route('/{record}/edit'),
        ];
    }
}
