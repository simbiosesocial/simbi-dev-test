'use client';

import { useState, type FunctionComponent } from "react";
import type { BookItemProps } from "./BookItem.interface";
import { Card, CardContent, CardMedia, CardActions, Button, Typography, Tooltip, Snackbar, Alert } from "@mui/material";
import { createLoan } from "@/requests/loans/createLoan";
import SnackAlert from "@/common/components/SnackAlert/SnackAlert.component";


export const BookItem: FunctionComponent<BookItemProps> = (book) => {
  const { id, title, coverUrl, isAvailable } = book;
  const [isLoading, setIsLoading] = useState(false);
  const [activatedLoan, setActivatedLoan] = useState<boolean>(!isAvailable);
  const [alertSuccess, setAlertSuccess] = useState({ open: false, message: '' });
  const [alertError, setAlertError] = useState({ open: false, message: '' });


  const handleLoan = async () => {
    setIsLoading(true);
    try {
      const data = await createLoan(id);
      setActivatedLoan(true);
      if (data) setAlertSuccess({ 
        open: true, 
        message: "Empréstimo realizado! Prazo de 7 dias para devolução." 
      });
    } catch (error) {
      console.error("Error creating loan:", error);
      setAlertError({ 
        open: true, 
        message: "Erro ao realizar empréstimo. Tente novamente."
      });
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

    <SnackAlert severity="success" state={alertSuccess} setState={setAlertSuccess} />
    <SnackAlert severity="error" state={alertError} setState={setAlertError} />
    </>
  );
};
