import {
  Dialog,
  DialogTitle,
  DialogContent,
  DialogActions,
  TextField,
  Button,
  DialogContentText,
  Autocomplete,
  createFilterOptions,
  Snackbar,
  Alert,
} from '@mui/material';
import { Dispatch, SetStateAction, useEffect, useState } from 'react';
import AddAuthorDialog, { AuthorName } from '../Dialog/AddAuthorDialog.component';
import { createAuthor } from '@/requests/authors/createAuthor';
import { getAuthors } from '@/requests/authors/getAuthors';
import SnackAlert from '@/common/components/SnackAlert/SnackAlert.component';

export interface AuthorOptionType {
  id?: string;
  name: string;
  inputValue?: string;
}

const filter = createFilterOptions<AuthorOptionType>();

interface AddAuthorDialogProps {
  author: AuthorOptionType | undefined, 
  setAuthor: Dispatch<SetStateAction<AuthorOptionType | undefined>>
}

const SelectAuthor = ({ author, setAuthor }: AddAuthorDialogProps) => {
  const [openAddAuthor, toggleOpenAddAuthor] = useState<boolean>(false);
  const [addAuthorData, setAddAuthorData] = useState<AuthorName>({ firstName: '', lastName: '' });
  const [authorsList, setAuthorsList] = useState<AuthorOptionType[]>([]);
  const [snackSuccess, setSnackSuccess] = useState<boolean>(false);
  const [snackError, setSnackError] = useState<boolean>(false);


  useEffect(() => {
    const fetchAuthorsList = async () => {
      const authorsList = await getAuthors();
      if(!authorsList) {
        setSnackError(true);
      }
      setAuthorsList(authorsList as AuthorOptionType[]);
    }

    fetchAuthorsList();
  }, [])

  const handleCloseDialog = () => {
    setAddAuthorData({
      firstName: '',
      lastName: '',
    });
    toggleOpenAddAuthor(false);
  };

  const handleSubmitAddAuthor = async (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    const newAuthor = await createAuthor(addAuthorData);
    if(newAuthor){ 
      setSnackSuccess(true);
      handleCloseDialog();
    }
    setAuthor(newAuthor);
  };

  return (
    <>
      <AddAuthorDialog 
        open={openAddAuthor} 
        handleClose={handleCloseDialog}
        handleSubmit={handleSubmitAddAuthor}
        dialogValue={addAuthorData}
        setDialogValue={setAddAuthorData}
      />

      <SnackAlert severity='success' open={snackSuccess} setOpen={setSnackSuccess}>
        Author adicionado com sucesso!
      </SnackAlert>
      <SnackAlert severity='error' open={snackError} setOpen={setSnackError}>
        Erro ao buscar autores.
      </SnackAlert>

      <Autocomplete
        value={author}
        onChange={(event, newValue) => {
          if (typeof newValue === 'string') {
            setTimeout(() => {
              toggleOpenAddAuthor(true);
              const [firstName, ...lastName] = newValue.split(' ');
              setAddAuthorData({
                firstName: firstName,
                lastName: lastName.join(' '),
              });
            });
            } else if (newValue && newValue.inputValue) {
              toggleOpenAddAuthor(true);
              setAddAuthorData({
                firstName: newValue.inputValue,
                lastName: '',
              });
            } else {
              setAuthor(newValue ?? undefined);
            }
          }}
        filterOptions={(options, params) => {
          const filtered = filter(options, params);

          if (params.inputValue !== '') {
            filtered.push({
              inputValue: params.inputValue,
              name: `Add "${params.inputValue}"`,
            });
          }
          return filtered;
        }}
        id="select-or-create-author"
        options={authorsList}
        getOptionLabel={(option) => {
          if (typeof option === 'string') {
            return option;
          }
          if (option.inputValue) {
            return option.inputValue;
          }
          return option.name;
        }}
        renderInput={(params) => (
          <TextField {...params} label="Autor" fullWidth />
        )}
        freeSolo
        autoHighlight
        selectOnFocus
        clearOnBlur
        handleHomeEndKeys
        renderOption={(props, option) => {
          const { key, ...optionProps } = props;
          return (
            <li key={key} {...optionProps}>
              {option.name}
            </li>
          );
        }}
        sx={{ width: 300 }}
      />
    </>
  );
}

export default SelectAuthor;