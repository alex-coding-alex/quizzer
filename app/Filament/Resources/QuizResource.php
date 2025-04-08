<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuizResource\Pages;
use App\Models\Quiz;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class QuizResource extends Resource
{
    protected static ?string $model = Quiz::class;

    protected static ?string $slug = 'quizzes';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([//
                TextInput::make('name')
                    ->required(),

                TextInput::make('description')
                    ->required(),

                Select::make('roles')
                    ->label('Assigned to these roles')
                    ->relationship('roles', 'name')
                    ->required(),

                SpatieTagsInput::make('tags'),

                Repeater::make('questions')
                    ->relationship()
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        Checkbox::make('is_multi_choice')
                            ->live()
                            ->default(true),

                        Section::make('Multiple Choice Questions')
                            ->description('Multiple Choice Questions')
                            ->schema([
                                TextInput::make('question_a')
                                    ->label('Question A')
                                    ->required(),
                                TextInput::make('question_b')
                                    ->label('Question B')
                                    ->required(),
                                TextInput::make('question_c')
                                    ->label('Question C')
                                    ->required(),
                                TextInput::make('question_d')
                                    ->label('Question D')
                                    ->required(),
                                Select::make('multi_choice_answer')
                                    ->options([
                                        'question_a' => 'A',
                                        'question_b' => 'B',
                                        'question_c' => 'C',
                                        'question_d' => 'D',
                                    ])
                                    ->required(),
                            ])
                            ->visible(fn (Get $get): bool => $get('is_multi_choice')),

                        Section::make('Free Questions')
                            ->description('Free Questions')
                            ->schema([
                                Textarea::make('free_question')
                                    ->required(),
                            ])
                            ->visible(fn (Get $get): bool => ! $get('is_multi_choice')),
                    ])
                    ->required(),

                Select::make('user_id')
                    ->disabled()
                    ->relationship('user', 'name')
                    ->default(Auth::user()->id)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('description'),

                SpatieTagsColumn::make('tags'),

                TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuizzes::route('/'),
            'create' => Pages\CreateQuiz::route('/create'),
            'edit' => Pages\EditQuiz::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['user']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'user.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->user) {
            $details['User'] = $record->user->name;
        }

        return $details;
    }
}
