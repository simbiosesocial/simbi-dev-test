'use client';

import { useState, type FunctionComponent } from "react";
import type { LoanItemProps } from "./LoanItem.interface";
import { Card, CardContent, CardMedia, CardActions, Button, Typography, Tooltip, Alert, Snackbar } from "@mui/material";
import { finalizeLoan, renewLoan } from "@/requests/loans/updateLoan";

const formatDateToLocal = (dateString: string): string => {
  const date = new Date(dateString);
  const utcDate = new Date(date.getTime() + date.getTimezoneOffset() * 60000);
  return utcDate.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
};

export const LoanItem: FunctionComponent<LoanItemProps> = ({ id, status, returnDate, returnedAt, book }) => {
  const [isLoadingRenew, setIsLoadingRenew] = useState(false);
  const [isLoadingFinalize, setIsLoadingFinalize] = useState(false);
  const [openSuccess, setOpenSuccess] = useState(false);
  const [openError, setOpenError] = useState(false);
  const finished = status === 'finished';

  const formattedReturnDate = formatDateToLocal(returnDate);
  const formattedReturnedAt = returnedAt && formatDateToLocal(returnedAt);


  const handleRenewLoan = async () => {
    setIsLoadingRenew(true);
    try {
      const data = await renewLoan(id);
      setIsLoadingRenew(false);
      if (data) setOpenSuccess(true);
    } catch (error) {
      setOpenError(true);
      console.error("Error renewing loan:", error);
    }
  }

  const handleFinalizeLoan = async () => {
    setIsLoadingFinalize(true);
    try {
      const data = await finalizeLoan(id);
      setIsLoadingFinalize(false);
      if (data) setOpenSuccess(true);
    } catch (error) {
      setOpenError(true);
      console.error("Error finalizing loan:", error);
    }
  }

  const handleDisabled = () => {
    if (finished) {
      return true;
    } else {
      if (isLoadingRenew || isLoadingFinalize) {
        return true;
      }
    }
    return false;
  }

  return (
    <>
    <Card variant="outlined">
      <CardMedia sx={{ height: 264 }} image={book.coverUrl ? book.coverUrl : "/cover.png"} title={book.title} />
      <CardContent>
        <Tooltip title={book.title} arrow>
          <Typography gutterBottom variant="h5" noWrap>
            {book.title}
          </Typography>
        </Tooltip>
        
        <Typography variant="overline">
          Status: {status}
        </Typography>

        {finished ? 
          (<Typography>
            Devolvido: {formattedReturnedAt}
          </Typography>)
        :
          (<Typography>
            Data de devolução: {formattedReturnDate}
          </Typography>)
          }
      </CardContent>
      <CardActions>
        <Button 
          size="small" 
          variant="contained" 
          fullWidth 
          onClick={handleRenewLoan}
          disabled={handleDisabled()}
        >
          {isLoadingRenew ? "Processando..." : "Renovar"}
        </Button>
        <Button 
          size="small" 
          variant="contained" 
          fullWidth 
          onClick={handleFinalizeLoan}
          disabled={handleDisabled()}
        >
          {isLoadingFinalize ? "Processando..." : "Devolver"}
        </Button>
      </CardActions>
    </Card>
    <Snackbar 
      open={openSuccess} 
      autoHideDuration={3500} 
      onClose={() => setOpenSuccess(false)}
      anchorOrigin={{ vertical: 'bottom', horizontal: 'right' }}
    >
      <Alert
        onClose={() => setOpenSuccess(false)}
        severity="success"
        variant="filled"
        sx={{ width: '100%' }}
      >
        Empréstimo atualizado com sucesso!
      </Alert>
    </Snackbar>
    <Snackbar 
      open={openError} 
      autoHideDuration={3500} 
      onClose={() => setOpenError(false)}
      anchorOrigin={{ vertical: 'bottom', horizontal: 'right' }}
    >
      <Alert
        onClose={() => setOpenError(false)}
        severity="error"
        variant="filled"
        sx={{ width: '100%' }}
      >
        Erro ao atualizar empréstimo. Tente novamente.
      </Alert>
    </Snackbar>
  </>
  );
};
