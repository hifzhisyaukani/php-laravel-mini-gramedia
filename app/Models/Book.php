<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

//nama-nama field yang akan diisi oleh pengguna /sistem, bukan default dari database
//id dan timestamps : diisi default oleh sistem database, jadi tidak di daftarkan disini
#[Fillable (['cover', 'title', 'price', 'description', 'language', 'publisher', 'writer', 'release_date', 'page_of_book', 'book_category_id'])]


class Book extends Model
{
    //Nama tunggal tanpa s/es kareng book_categories berperan sebagai one
    //pada relasi one to many milik kategori buku
    public function bookCategory(): BelongsTo
    {
        return $this->belongsTo(BookCategory::class);
    }

    public function checkoutBooks():HasMany
    {
        return $this->hasMany(CheckoutBook::class);
    }

    public function SubscriptionPackageBook(): HasMany
    {
        return $this->hasMany(SubscriptionPackageBook::class);
    }
}
