import React from 'react';
import { render, screen, fireEvent, waitFor } from "@/common/utils/test-utils";
import SelectAuthor from './SelectAuthor.component';
import { getAuthors } from '@/requests/authors/getAuthors';
import { createAuthor } from '@/requests/authors/createAuthor';
import { authorsList } from './SelectAuthor.mock';

jest.mock('@/requests/authors/getAuthors');
jest.mock('@/requests/authors/createAuthor');

const mockGetAuthors = getAuthors as jest.MockedFunction<typeof getAuthors>;
const mockCreateAuthor = createAuthor as jest.MockedFunction<typeof createAuthor>;

const mockSetAuthor = jest.fn();

const defaultProps = {
  author: undefined,
  setAuthor: mockSetAuthor,
};

describe('SelectAuthor', () => {
  beforeEach(() => {
    mockGetAuthors.mockClear();
    mockCreateAuthor.mockClear();
    mockSetAuthor.mockClear();
  });

  it('should render the component and fetch authors', async () => {
    mockGetAuthors.mockResolvedValueOnce(authorsList);

    render(<SelectAuthor {...defaultProps} />);

    expect(screen.getByLabelText('Autor')).toBeInTheDocument();
    fireEvent.change(screen.getByLabelText('Autor'), { target: { value: 'J' } });

    await waitFor(() => {
      expect(mockGetAuthors).toHaveBeenCalled();
      expect(screen.getByText('John Doe')).toBeInTheDocument();
      expect(screen.getByText('Jane Smith')).toBeInTheDocument();
    });
  });

  it('should show error message if fetching authors fails', async () => {
    mockGetAuthors.mockResolvedValueOnce(undefined);

    render(<SelectAuthor {...defaultProps} />);

    await waitFor(() => {
      expect(mockGetAuthors).toHaveBeenCalled();
      expect(screen.getByText('Erro ao buscar autores.')).toBeInTheDocument();
    });
  });

  it('should show `Adicionar "New Author"` when a new author is typed', async () => {
    mockGetAuthors.mockResolvedValueOnce(authorsList);

    render(<SelectAuthor {...defaultProps} />);

    fireEvent.change(screen.getByLabelText('Autor'), { target: { value: 'New Author' } });

    await waitFor(() => {
      expect(screen.getByText('Adicionar "New Author"')).toBeInTheDocument();
    });
    
  });

  it('should add a new author and update the list', async () => {
    mockGetAuthors.mockResolvedValueOnce(authorsList);
    const newAuthor = { id: '3', name: 'New Author' };
    mockCreateAuthor.mockResolvedValueOnce(newAuthor);

    render(<SelectAuthor {...defaultProps} />);

    fireEvent.change(screen.getByLabelText('Autor'), { target: { value: 'New Author' } });

    const addNewAuthor = screen.getByText('Adicionar "New Author"');
    await waitFor(() => {
      expect(addNewAuthor).toBeInTheDocument();
    });

    fireEvent.click(addNewAuthor);
    
    await waitFor(() => {
      const dialogTitle = screen.getByText('Adicionar novo autor');
      expect(dialogTitle).toBeInTheDocument();
      
      expect(screen.getByLabelText('Nome')).toHaveValue("New");
      expect(screen.getByLabelText('Sobrenome')).toHaveValue("Author");
    });

    fireEvent.submit(screen.getByRole('button', { name: 'Adicionar Autor' }));

    await waitFor(() => {
      expect(mockCreateAuthor).toHaveBeenCalledWith({ firstName: 'New', lastName: 'Author' });
      expect(mockSetAuthor).toHaveBeenCalledWith(newAuthor);
      expect(screen.getByText('Autor adicionado com sucesso!')).toBeInTheDocument();
      
      fireEvent.change(screen.getByLabelText('Autor'), { target: { value: 'New' } });
      expect(screen.getByText('New Author')).toBeInTheDocument();
    });
  });
});