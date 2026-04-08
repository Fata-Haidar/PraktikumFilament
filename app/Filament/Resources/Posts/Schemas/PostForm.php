<?php

namespace App\Filament\Resources\Posts\Schemas;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select; 
use Filament\Forms\Components\ColorPicker; 
use Filament\Forms\Components\MarkdownEditor; 
use Filament\Forms\Components\RichEditor; 
use Filament\Forms\Components\FileUpload; 
use Filament\Forms\Components\TagsInput; 
use Filament\Forms\Components\Checkbox; 
use Filament\Forms\Components\DatePicker; 
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Group;

use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //section 1 - post detail
                Section::make('Post Details')
                ->description('Fill the details of the post')
                ->icon('heroicon-o-document-text') //icon 1
                ->schema([
                    //grouping2
                    Group::make ([
                TextInput::make(name: 'title')
                ->rules('required | min:5 |max:10'),
                TextInput::make('slug')
                ->rules(['required', 'min:3'])
                ->unique()
                ->validationMessages([
                    'unique' => 'slug harus Unik.',
                ]),
                Select::make('category_id') 
                ->relationship("Category", "name")
                ->required()
                ->preload()
                ->searchable()
                ->validationMessages([
                    'required' => 'Category wajib dipilih.',
                ]),
                ColorPicker::make(name: 'color'),
                ])->columns(2),

                MarkdownEditor::make('content'), 
                ])->columnSpan(2),

                //RichEditor::make('content'),
                //Grouping fieds into 2 columns
                Group::make([
                //Section 2-Image
                Section::make('Image Upload')
                ->icon('heroicon-o-photo') //icon2
                ->schema([
                FileUpload::make('image')
                ->required()
                ->disk("public")
                ->directory('posts')
                ->validationMessages([
                    'required' => 'image wajib diupload.',
                ]),
                ]),

                //Section 3 - Meta
                Section::make('Meta Information')
                ->icon('heroicon-o-cog-6-tooth') //icon3
                ->schema([
                TagsInput::make('tags'),
                Checkbox::make('published')->default(false),
                DatePicker::make('published_at'),
                ]),
                  ])->columnSpan(1),
            ])->columns(3);
    }
}