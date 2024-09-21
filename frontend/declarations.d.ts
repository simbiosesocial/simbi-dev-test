type Author = {
  id: string;
  name: string;
};

type Book = {
  id: string;
  title: string;
  author: Author;
  publisher: string;
  coverUrl?: string;
  createdAt: string;
  updatedAt: string;
};

type BookLoan = {
  id?: string;
  user_email: string;
  book_id: string;
  author_id?: string;
  loan_date: string;
  return_date: string;
}