import React, { useState } from 'react';
import {
  Dialog,
  DialogTitle,
  DialogContent,
  DialogActions,
  TextField,
  Button,
  Grid,
} from '@mui/material';
import SelectAuthor, { AuthorOptionType } from '../AddAuthor/Select/SelectAuthor.component';
import { createBook } from '@/requests/books/createBook';
import SnackAlert from '@/common/components/SnackAlert/SnackAlert.component';

const AddBookDialog = ({ open, onClose }: any) => {
  const [ISBN, setISBN] = useState('');
  const [title, setTitle] = useState('');
  const [author, setAuthor] = useState<AuthorOptionType | undefined>(undefined);
  const [publisher, setPublisher] = useState('');
  const [snackSuccess, setSnackSuccess] = useState(false);
  const [snackError, setSnackError] = useState(false);

  const handleFetchBookInfo = async () => {
    if (!ISBN) return;
    try {
      const response = await fetch(`https://www.googleapis.com/books/v1/volumes?isbn=${ISBN}`, {
        method: 'GET',
      });
      if(response){
        const data = await response.json();
        console.log('data book', data);

        if (data.items && data.data.items.length > 0) {
          const book = data.data.items[0].volumeInfo;
          setTitle(book.title || '');
          setPublisher(book.publisher || '');
          if (book.authors && book.authors.length > 0) {
            const firstAuthor = book.authors[0];
            const name = firstAuthor;
            setAuthor({ name });
          }
        }
      }
    } catch (error) {
      console.error('Error fetching book info:', error);
    }
  };

  const handleSubmit = async () => {
    const authorId = author?.id as string;
    const bookData = {
      title,
      authorId,
      publisher,
    };
    const newBook = await createBook(bookData);
    if (newBook) {
      setSnackSuccess(true);
      onClose();
    } else {
      setSnackError(true);
    }
  };

  return (
    <Dialog open={open} onClose={onClose}>

      <SnackAlert severity='success' open={snackSuccess} setOpen={setSnackSuccess}>
        Livro adicionado com sucesso!
      </SnackAlert>
      <SnackAlert severity='error' open={snackError} setOpen={setSnackError}>
        Erro ao adicionar livro. Tente novamente
      </SnackAlert>

      <DialogTitle>Adicionar Novo Livro</DialogTitle>
      <DialogContent>
        <Grid container spacing={2}>
          <Grid item xs={12}>
            <TextField
              label="ISBN"
              fullWidth
              value={ISBN}
              onChange={(e) => setISBN(e.target.value)}
              onBlur={handleFetchBookInfo}
            />
          </Grid>
          <Grid item xs={12}>
            <TextField
              label="Título"
              fullWidth
              value={title}
              onChange={(e) => setTitle(e.target.value)}
            />
          </Grid>
          <Grid item xs={12}>
            <SelectAuthor author={author} setAuthor={setAuthor} />
          </Grid>
          <Grid item xs={12}>
            <TextField
              label="Editora"
              fullWidth
              value={publisher}
              onChange={(e) => setPublisher(e.target.value)}
            />
          </Grid>
        </Grid>
      </DialogContent>
      <DialogActions>
        <Button onClick={onClose}>Cancelar</Button>
        <Button onClick={handleSubmit} color="primary" variant="contained">
          Adicionar
        </Button>
      </DialogActions>
    </Dialog>
  );
};

export default AddBookDialog;