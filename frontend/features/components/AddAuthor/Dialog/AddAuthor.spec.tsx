import React from 'react';
import { render, screen, fireEvent } from '@testing-library/react';
import { AddAuthorDialogProps } from './AddAuthor.interface';
import AddAuthorDialog from './AddAuthor.component';

const mockHandleClose = jest.fn();
const mockHandleSubmit = jest.fn((e) => e.preventDefault());
const mockSetDialogValue = jest.fn();

const defaultProps: AddAuthorDialogProps = {
  open: true,
  handleClose: mockHandleClose,
  handleSubmit: mockHandleSubmit,
  setDialogValue: mockSetDialogValue,
  dialogValue: { firstName: '', lastName: '' },
};

describe('AddAuthorDialog', () => {
  it('should render the dialog with the correct elements', () => {
    render(<AddAuthorDialog {...defaultProps} />);

    expect(screen.getByText('Adicionar novo autor')).toBeInTheDocument();
    expect(screen.getByText('Não encontrou o autor? Então adicione!')).toBeInTheDocument();
    expect(screen.getByLabelText('Nome')).toBeInTheDocument();
    expect(screen.getByLabelText('Sobrenome')).toBeInTheDocument();
    expect(screen.getByText('Cancelar')).toBeInTheDocument();
    expect(screen.getByText('Adicionar Autor')).toBeInTheDocument();
  });

  it('should call setDialogValue when first name is changed', () => {
    render(<AddAuthorDialog {...defaultProps} />);

    fireEvent.change(screen.getByLabelText('Nome'), { target: { value: 'John' } });
    expect(mockSetDialogValue).toHaveBeenCalledWith({ firstName: 'John', lastName: '' });
  });

  it('should call setDialogValue when last name is changed', () => {
    render(<AddAuthorDialog {...defaultProps} />);

    fireEvent.change(screen.getByLabelText('Sobrenome'), { target: { value: 'Doe' } });
    expect(mockSetDialogValue).toHaveBeenCalledWith({ firstName: '', lastName: 'Doe' });
  });

  it('should call handleClose when cancel button is clicked', () => {
    render(<AddAuthorDialog {...defaultProps} />);

    fireEvent.click(screen.getByText('Cancelar'));
    expect(mockHandleClose).toHaveBeenCalled();
  });

  it('should call handleSubmit when form is submitted', () => {
    render(<AddAuthorDialog {...defaultProps} />);

    fireEvent.submit(screen.getByRole('button', { name: 'Adicionar Autor' }));
    expect(mockHandleSubmit).toHaveBeenCalled();
  });
});