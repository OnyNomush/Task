<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjekResource\Pages;
use App\Models\Projek;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProjekResource extends Resource
{
    protected static ?string $model = Projek::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Product';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                    
                Forms\Components\Textarea::make('deskripsi')
                    ->maxLength(1000)
                    ->rows(4),
                    
                Forms\Components\DatePicker::make('tanggal_mulai')
                    ->label('Tanggal Mulai')
                    ->required(),

                Forms\Components\DatePicker::make('tanggal_selesai')
                    ->label('Tanggal Selesai')
                    ->required(),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'Belum Dikerjakan' => 'Belum Dikerjakan',
                        'Dalam Proses' => 'Dalam Proses',
                        'Siap Launch' => 'Siap Launch',
                    ])
                    ->required()
                    ->default('Belum Dikerjakan')
                    ->disablePlaceholderSelection(), // Ini menghilangkan opsi kosong
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('deskripsi')
                    ->limit(50)
                    ->wrap(),

                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->date()
                    ->label('Mulai'),

                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->date()
                    ->label('Selesai'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Dibuat'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Belum Dikerjakan' => 'gray',
                        'Dalam Proses' => 'warning',
                        'Siap Launch' => 'success',
                    }),

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
            'index' => Pages\ListProjeks::route('/'),
            'create' => Pages\CreateProjek::route('/create'),
            'edit' => Pages\EditProjek::route('/{record}/edit'),
        ];
    }
}
