@foreach ($books as $book)
  <option value="{{$book->book}}">{{$book->book}}</option>
@endforeach