<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TugasResource\Pages;
use App\Filament\Resources\TugasResource\RelationManagers;
use App\Models\Tugas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TugasResource extends Resource
{
    protected static ?string $model = Tugas::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Product';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')->required(),
                Forms\Components\Textarea::make('deskripsi'),
                Forms\Components\DatePicker::make('tanggal_deadline'),
                Forms\Components\Select::make('projek_id')
                ->label('Projek')
                ->relationship('projek', 'nama') // pastikan relasi ini ada di model Tugas
                ->searchable()
                ->preload()
                ->required(),
                Forms\Components\Select::make('pic')
                ->label('PIC')
                ->multiple()
                ->relationship('pic', 'name') // pakai kolom 'name' dari tabel users
                ->preload()
                ->searchable(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->searchable(),
                Tables\Columns\TextColumn::make('projek.nama')->label('Projek'),
                Tables\Columns\TextColumn::make('tanggal_deadline')->date(),
                Tables\Columns\TextColumn::make('pic.name')
                    ->label('PIC')
                    ->separator(', ')
                    ->limit(3), // tampilkan max 3, sisanya "..."
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListTugas::route('/'),
            'create' => Pages\CreateTugas::route('/create'),
            'edit' => Pages\EditTugas::route('/{record}/edit'),
        ];
    }
}
