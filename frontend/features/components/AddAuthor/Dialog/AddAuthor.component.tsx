import {
  Dialog,
  DialogTitle,
  DialogContent,
  DialogActions,
  TextField,
  Button,
  DialogContentText,
} from '@mui/material';
import { AddAuthorDialogProps } from './AddAuthor.interface';



const AddAuthorDialog = ({ 
  open, 
  handleClose, 
  handleSubmit, 
  setDialogValue, 
  dialogValue 
}: AddAuthorDialogProps) => {
  return (
    <Dialog open={open} onClose={handleClose}>
      <form onSubmit={handleSubmit}>
        <DialogTitle>Adicionar novo autor</DialogTitle>
        <DialogContent>
          <DialogContentText>
            Não encontrou o autor? Então adicione!
          </DialogContentText>
          <TextField
            autoFocus
            margin="dense"
            id="firstName"
            value={dialogValue.firstName}
            onChange={(event) =>
              setDialogValue({
                ...dialogValue,
                firstName: event.target.value,
              })
            }
            label="Nome"
            type="text"
            variant="standard"
          />
          <TextField
            margin="dense"
            id="lastName"
            value={dialogValue.lastName}
            onChange={(event) =>
              setDialogValue({
                ...dialogValue,
                lastName: event.target.value,
              })
            }
            label="Sobrenome"
            type="text"
            variant="standard"
          />
        </DialogContent>
        <DialogActions>
          <Button onClick={handleClose}>Cancelar</Button>
          <Button type="submit">Adicionar Autor</Button>
        </DialogActions>
      </form>
    </Dialog>
  );
}

export default AddAuthorDialog;
