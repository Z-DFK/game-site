<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandResource\Pages;
use App\Filament\Resources\BrandResource\RelationManagers;
use App\Models\Brand;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static ?string $modelLabel = "Категория";
    protected static ?string $pluralModelLabel = "Категории";

    protected static ?string $navigationLabel = 'Категории';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Категории')->schema([
                    TextInput::make('name')
                        ->label('Название категории')
                        ->maxLength(255)
                        ->required(),
                    TextInput::make('description')
                        ->label('Описание категории')
                        ->maxLength(255)
                        ->required(),
                        FileUpload::make('image')
                        ->image()
                        ->imageEditor()
                        ->directory('images/brand/')
                        ->label('Изображение категории')
                        ->columnSpanFull(),
                    Fieldset::make('Настройки')->schema([
                        Toggle::make('is_active')
                            ->default(true)
                            ->label('Активная категория'),
                        Toggle::make('is_popular')
                            ->default(false)
                            ->label('Популярная категория'),
                    ]),
                ])->columns(['sm' => 1])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->label('Название категории'),
                TextColumn::make('description')
                    ->label('Описание категории'),
                ImageColumn::make('image')
                    ->label('Изображение')
                    ->size(50)
                    ->circular()
                    ->square(),
                ToggleColumn::make('is_popular')
                    ->label('Популярная категория'),
                ToggleColumn::make('is_active')
                    ->label('Активная категория'),
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
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
}
