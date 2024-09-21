import { render, screen } from '@testing-library/react';
import { BookLoanList } from './BookLoanList.component';

describe('BookLoanList', () => {
  it('renders a list of loans', () => {
    const loans = [
      {
        id: '1',
        user_email: 'useruser1@example.com',
        book_id: '101',
        author_id: '201',
        loan_date: '2024-09-01',
        return_date: '2024-09-15',
      },
      {
        id: '2',
        user_email: 'user2@example.com',
        book_id: '102',
        author_id: '202',
        loan_date: '2024-09-05',
        return_date: '2024-09-20',
      },
    ];

    render(<BookLoanList loans={loans} />);

    expect(screen.getByText('Lista de Empréstimos')).toBeInTheDocument();
    expect(screen.getByText('useruser1@example.com')).toBeInTheDocument();
    expect(screen.getByText('Livro ID: 101')).toBeInTheDocument();
    expect(screen.getByText('Autor ID: 201')).toBeInTheDocument();
    expect(screen.getByText('Data de Empréstimo: 2024-09-01')).toBeInTheDocument();
    expect(screen.getByText('Data de Devolução: 2024-09-15')).toBeInTheDocument();

    expect(screen.getByText('user2@example.com')).toBeInTheDocument();
    expect(screen.getByText('Livro ID: 102')).toBeInTheDocument();
    expect(screen.getByText('Autor ID: 202')).toBeInTheDocument();
    expect(screen.getByText('Data de Empréstimo: 2024-09-05')).toBeInTheDocument();
    expect(screen.getByText('Data de Devolução: 2024-09-20')).toBeInTheDocument();
  });
});
