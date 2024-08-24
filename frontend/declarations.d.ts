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

type Loan = {
  id: string;
  loaned_book: Book;
  start_loan_date: string;
  end_loan_date: string;
};
