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
  createdAt?: string;
  updatedAt?: string;
  isAvailable: boolean;
};

export type LoanStatus = 
  | 'active'
  | 'finished'
  | 'overdue';

type Loan = {
  id: string;
  book: Book;
  loanDate: string;
  returnDate: string;
  status: LoanStatus;
  lastRenewedAt: string | null;
  renewalCount: number;
  returnedAt: string | null;
  createdAt: string;
  updatedAt: string;
};
