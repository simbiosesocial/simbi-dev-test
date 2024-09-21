"use client"
import { createLoan } from '@/common/utils/api';
import React, { useEffect, useState } from 'react';
import type { FunctionComponent } from "react";
import {useParams}  from "next/navigation";
import type { BookLoanProps } from "./BookLoan.interface";
import { TextField, Button, MenuItem, Grid, Box } from '@mui/material';

interface Props{
    books: Book[];
}

export const BookLoanForm: FunctionComponent<Props> = ({ books }) => {
  const { id } = useParams();
  const [email, setEmail] = useState('');
  const [selectedBook, setSelectedBook] = useState('');
  const [author, setAuthor] = useState<Author>();
  const [loanDate, setLoanDate] = useState('');
  const [returnDate, setReturnDate] = useState('');

  useEffect(() => {
      const book = books.find(book => book.id === id);

      if(book){
        setAuthor(book.author)
        setSelectedBook(book.title)
        console.log(book);
    }
  },[books, id])

  const handleSubmit = async (event: React.FormEvent) => {
    event.preventDefault();
  
    const loanData = {
      user_email: email,
      book_id: id.toLocaleString(),
      author_id: author?.id,
      loan_date: loanDate,
      return_date: returnDate,
    };
  
    try {
      const response = await createLoan(loanData);
      console.log(response);
      alert('Empréstimo registrado com sucesso!');
    } catch (error) {
      console.error('Erro ao registrar empréstimo', error);
      alert('Erro ao registrar empréstimo');
    }
  };

  return (
    <Box component="form" onSubmit={handleSubmit} sx={{ maxWidth: 500, margin: 'auto' }}>
      <Grid container spacing={2}>
        <Grid item xs={12}>
          <TextField
            fullWidth
            label="Email"
            type="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            required
          />
        </Grid>

        <Grid item xs={12}>
          <TextField
            fullWidth
            label="Livro"
            value={selectedBook}
            disabled
          />
        </Grid>

        <Grid item xs={12}>
          <TextField
            fullWidth
            label="Autor"
            value={author?.name}
            disabled
          />
        </Grid>

        <Grid item xs={6}>
          <TextField
            fullWidth
            label="Data de Empréstimo"
            type="date"
            InputLabelProps={{ shrink: true }}
            value={loanDate}
            onChange={(e) => setLoanDate(e.target.value)}
            required
          />
        </Grid>

        <Grid item xs={6}>
          <TextField
            fullWidth
            label="Data de Devolução"
            type="date"
            InputLabelProps={{ shrink: true }}
            value={returnDate}
            onChange={(e) => setReturnDate(e.target.value)}
            required
          />
        </Grid>

        <Grid item xs={12}>
          <Button fullWidth type="submit" variant="contained" color="primary">
            Salvar
          </Button>
        </Grid>
      </Grid>
    </Box>
  );
};
