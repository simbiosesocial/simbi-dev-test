import React, { useEffect, useState } from 'react';
import {
  Dialog,
  DialogTitle,
  DialogContent,
  DialogActions,
  TextField,
  Button,
  Grid,
} from '@mui/material';
import SelectAuthor from '../AddAuthor/Select/SelectAuthor.component';
import { createBook } from '@/requests/books/createBook';
import SnackAlert from '@/common/components/SnackAlert/SnackAlert.component';
import { AuthorOptionType } from '../AddAuthor/Select/SelectAuthor.interface';

const AddBookDialog = ({ open, onClose, setAllBooks }: any) => {
  // const [ISBN, setISBN] = useState('');
  const [title, setTitle] = useState('');
  const [author, setAuthor] = useState<AuthorOptionType>({ id: '', name: '' });
  const [publisher, setPublisher] = useState('');
  const [snackError, setSnackError] = useState({ open: false, message: '' });
  //TODO
  // const handleFetchBookInfo = async () => {
  //   if (!ISBN) return;
  //   try {
  //     const data = await fetchBookInfo(ISBN);

  //     if (data.items && data.data.items.length > 0) {
  //       const book = data.data.items[0].volumeInfo;
  //       setTitle(book.title || '');
  //       setPublisher(book.publisher || '');
  //       if (book.authors && book.authors.length > 0) {
  //         const firstAuthor = book.authors[0];
  //         const name = firstAuthor;
  //         setAuthor({ name });
  //       }
  //     }
  //   } catch (error) {
  //     console.error('Error fetching book info:', error);
  //   }
  // };

  const resetData = () => {
    // setISBN('');
    setTitle('');
    setAuthor({ id: '', name: '' });
    setPublisher('');
  }


  const handleSubmit = async () => {
    const authorId = author?.id as string;
    const bookData = {
      title,
      authorId,
      publisher,
    };
    const newBook = await createBook(bookData);
    if (newBook) {
      setAllBooks((prevBooks: Book[]) => [newBook, ...prevBooks]);
      resetData();
      onClose();
    } else {
      setSnackError({
        open:true,
        message: `Erro ao adicionar o livro ${title}. Tente novamente`,
      });
    }
  };

  return (
    <Dialog open={open} onClose={onClose}>

      <SnackAlert severity='error' state={snackError} setState={setSnackError} />
      <DialogTitle>Adicionar Novo Livro</DialogTitle>
      <DialogContent>
        <Grid container spacing={2}>
          {/* <Grid item xs={12}>
            <TextField
              label="ISBN"
              fullWidth
              value={ISBN}
              onChange={(e) => setISBN(e.target.value)}
              onBlur={handleFetchBookInfo}
            />
          </Grid> */}
          <Grid item xs={12}>
            <TextField
              label="Título"
              fullWidth
              value={title}
              onChange={(e) => setTitle(e.target.value)}
               sx={{ mt: 1 }}
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
        <Button onClick={() => { resetData(); onClose() }}>Cancelar</Button>
        <Button onClick={handleSubmit} color="primary" variant="contained">
          Adicionar
        </Button>
      </DialogActions>
    </Dialog>
  );
};

export default AddBookDialog;