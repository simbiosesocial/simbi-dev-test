import React, { act } from 'react';
import { fireEvent, waitFor } from '@testing-library/react';
import { render, screen } from "@/common/utils/test-utils";
import AddBookDialog from './AddBook.component';
import { createBook } from '@/requests/books/createBook';
import { getAuthors } from '@/requests/authors/getAuthors';
import { authorsList } from '../AddAuthor/Select/SelectAuthor.mock';

jest.mock('@/requests/books/createBook');
jest.mock('@/requests/authors/getAuthors');

const mockCreateBook = createBook as jest.MockedFunction<typeof createBook>;
const mockGetAuthors = getAuthors as jest.MockedFunction<typeof getAuthors>;

const mockSetAllBooks = jest.fn();;

const mockOnClose = jest.fn();

const defaultProps = {
  open: true,
  onClose: mockOnClose,
  setAllBooks: mockSetAllBooks,
};

describe('AddBookDialog', () => {
  beforeEach(() => {
    mockCreateBook.mockClear();
    mockSetAllBooks.mockClear();
    mockOnClose.mockClear();
    mockGetAuthors.mockClear();

    act(() => {
      mockGetAuthors.mockResolvedValue(authorsList);
    });
  });

  const bookTitle = 'New Book Title';
  const bookAuthor = 'A';
  const bookPublisher = 'Publisher';

  it('should render the component with the correct elements', () => {
    mockGetAuthors.mockResolvedValueOnce(authorsList);
    act(() => {
      render(<AddBookDialog {...defaultProps} />);
    });
    
    expect(screen.getByText('Adicionar Novo Livro')).toBeInTheDocument();
    expect(screen.getByLabelText('Título')).toBeInTheDocument();
    expect(screen.getByRole('combobox')).toBeInTheDocument();
    expect(screen.getByLabelText('Editora')).toBeInTheDocument();
    expect(screen.getByText('Cancelar')).toBeInTheDocument();
    expect(screen.getByText('Adicionar')).toBeInTheDocument();
  });

  it('should update the title, author and publisher fields when changed', () => {
    mockGetAuthors.mockResolvedValueOnce(authorsList);
    act(() => {
      render(<AddBookDialog {...defaultProps} />);
    });

    act(() => {
      fireEvent.change(screen.getByLabelText('Título'), { target: { value: bookTitle } });
      fireEvent.change(screen.getByRole('combobox'), { target: { value: bookAuthor } });
      fireEvent.change(screen.getByLabelText('Editora'), { target: { value: bookPublisher } });
    });
    expect(screen.getByLabelText('Título')).toHaveValue(bookTitle);
    expect(screen.getByRole('combobox')).toHaveValue(bookAuthor);
    expect(screen.getByLabelText('Editora')).toHaveValue(bookPublisher);
  });

  it('should call onClose and reset data when Cancelar is clicked', () => {
    mockGetAuthors.mockResolvedValueOnce(authorsList);
    act(() => {
      render(<AddBookDialog {...defaultProps} />);
    });

    fireEvent.click(screen.getByText('Cancelar'));

    expect(mockOnClose).toHaveBeenCalled();
    expect(screen.getByLabelText('Título')).toHaveValue('');
    expect(screen.getByRole('combobox')).toHaveValue('');
    expect(screen.getByLabelText('Editora')).toHaveValue('');
  });

  it('should call createBook and update the list when Adicionar is clicked', async () => {
    const newBook = { id: '1', title: bookTitle, author: { id: '2', name: bookAuthor }, isAvailable: true, publisher: bookPublisher };
    mockCreateBook.mockResolvedValue(newBook);

    mockGetAuthors.mockResolvedValueOnce(authorsList);
    act(() => {
      render(<AddBookDialog {...defaultProps} />);
    });

    act(() => {
      fireEvent.change(screen.getByLabelText('Título'), { target: { value: bookTitle } });
      fireEvent.change(screen.getByRole('combobox'), { target: { value: bookAuthor } });
      fireEvent.keyDown(screen.getByRole('combobox'), { key: 'Enter', code: 'Enter' });
      fireEvent.change(screen.getByLabelText('Editora'), { target: { value: bookPublisher } });
    });
    fireEvent.click(screen.getByText('Adicionar'));

    await waitFor(() => {
      expect(mockCreateBook).toHaveBeenCalled();
      expect(mockSetAllBooks).toHaveBeenCalledWith(expect.any(Function));
      expect(mockOnClose).toHaveBeenCalled();
    });
  });

  it('should show error message if createBook fails', async () => {
    mockCreateBook.mockResolvedValueOnce(undefined);

    render(<AddBookDialog {...defaultProps} />);

    act(() => {
      fireEvent.change(screen.getByLabelText('Título'), { target: { value: bookTitle } });
      fireEvent.change(screen.getByLabelText('Editora'), { target: { value: bookPublisher } });
    });
    fireEvent.click(screen.getByText('Adicionar'));

    await waitFor(() => {
      expect(screen.getByText(`Erro ao adicionar o livro ${bookTitle}. Tente novamente`)).toBeInTheDocument();
    });
  });
});