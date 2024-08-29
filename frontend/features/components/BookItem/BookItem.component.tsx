'use client';

import { useState, type FunctionComponent } from "react";
import type { BookItemProps } from "./BookItem.interface";
import { Card, CardContent, CardMedia, CardActions, Button, Typography, Tooltip, Snackbar, Alert } from "@mui/material";
import { createLoan } from "@/requests/loans/createLoan";


export const BookItem: FunctionComponent<BookItemProps> = (book) => {
  const { id, title, coverUrl, isAvailable } = book;
  const [isLoading, setIsLoading] = useState(false);
  const [activatedLoan, setActivatedLoan] = useState<boolean>(!isAvailable);
  const [openSuccess, setOpenSuccess] = useState(false);
  const [openError, setOpenError] = useState(false);

  const handleLoan = async () => {
    setIsLoading(true);
    try {
      const data = await createLoan(id);
      setActivatedLoan(true);
      if (data) setOpenSuccess(true);
    } catch (error) {
      console.error("Error creating loan:", error);
      setOpenError(true);
    } finally {
      setIsLoading(false);
    }
  }
  return (
    <>
    <Card variant="outlined">
      <CardMedia sx={{ height: 264 }} image={coverUrl ? coverUrl : "/cover.png"} title={title} />
      <CardContent>
        <Tooltip title={title} arrow>
          <Typography gutterBottom variant="h5" noWrap>
            {title}
          </Typography>
        </Tooltip>
        <Typography variant="body2" color="text.secondary">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam non arcu...
        </Typography>
      </CardContent>
      <CardActions>
        <Button 
          size="small" 
          variant="contained" 
          fullWidth 
          onClick={handleLoan}
          disabled={isLoading || activatedLoan}
        >
          {isLoading ? "Processando..." : activatedLoan ? 'Emprestado' : "Empréstimo" } 
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
        Empréstimo realizado! Prazo de 7 dias para devolução.
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
        Erro ao realizar empréstimo. Tente novamente.
      </Alert>
    </Snackbar>
    </>
  );
};
