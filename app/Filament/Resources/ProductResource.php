<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Tables\Filters\Filter;
use Doctrine\DBAL\Types\IntegerType;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Integer;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $modelLabel = "Игры";
    protected static ?string $pluralModelLabel = "Игры";

    protected static ?string $navigationLabel = 'Игры';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Новая игра')->schema([
                        TextInput::make('name')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->required()
                            ->label('Название игры'),
                        Textarea::make('description')
                            ->label('Описание игры')
                            ->minLength(10)
                            ->columnSpanFull()
                            ->rows(10),
                        TextInput::make('weight')
                            ->label('Вес товара')
                            ->maxLength(255),
                        TextInput::make('material')
                            ->label('Материал товара')
                            ->maxLength(255),
                        TextInput::make('price')
                            ->label('Стоимость игры в рублях')
                            ->maxLength(255),
                        TextInput::make('colour')
                            ->label('Цвет игры')
                            ->maxLength(255),
                    ])->columns(2)->columnSpanFull(),
                    Section::make()->schema([
                        FileUpload::make('image')
                            ->label('Изображение игры')
                            ->image()
                            ->directory('images/prod/')
                            ->required(),
                    ])->columnSpanFull(),
            ])->columnSpan(2),
            Group::make()->schema([
                Section::make()->schema([
                    Select::make('brand_id')
                        ->required()
                        ->preload()
                        ->searchable()
                        ->label('Категория')
                        ->relationship('brand', 'name')
                ]),
                Section::make()->schema([
                    Toggle::make('is_active')
                        ->label('Товар в наличии')
                        ->helperText('Товар будет показан в каталоге')
                        ->default(true),
                    Toggle::make('is_popular')
                        ->label('Популярный товар')
                        ->helperText('Товар будет добавлен во вкладку "Популярное"')
                        ->default(false),
                ]),
            ])->columnSpan(1),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->label('Название игры'),
                TextColumn::make('brand.name')
                    ->label('Категория игры')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Описание игры'),
                ImageColumn::make('image')
                    ->size(52)
                    ->circular()
                    ->label('Изображение'),
                ToggleColumn::make('is_active')
                    ->label('Активный продукт'),
            ])
            ->filters([
                Filter::make('is_active')
                    ->label('Актывные товары')
                    ->query(fn (Builder $query): Builder => $query->where('is_active', true)),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
