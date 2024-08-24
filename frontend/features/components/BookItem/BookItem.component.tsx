import { useState, type FunctionComponent } from "react";
import type { BookItemProps } from "./BookItem.interface";
import { Card, CardContent, CardMedia, CardActions, Button, Typography, Tooltip } from "@mui/material";
import loanBook from "@/services/loanBook";
import dateObjToApiFormat from "@/common/utils/dateObjToApiFormat";

export const BookItem: FunctionComponent<BookItemProps> = ({ title, coverUrl, id }) => {
  const [loanProcess, setLoanProces] = useState<{isLoaning: boolean, message: string}>({isLoaning: false, message: "Aguarde"});

  const handleLoanBookAction = async (bookId: string) => {
    setLoanProces({isLoaning: true, message: "Emprestando Livro"});
    console.log('clicked');
    const today = new Date();
    const todayFormatted = dateObjToApiFormat(today);

    const eightDaysLater = new Date();
    eightDaysLater.setDate(today.getDate() + 8);
    const eightDaysLaterFormatted = dateObjToApiFormat(eightDaysLater);

    try {
      await loanBook(bookId, todayFormatted, eightDaysLaterFormatted);
      setLoanProces({isLoaning: true, message: "Livro Emprestado! 😀"})
    } catch (error) {
      setLoanProces({isLoaning: true, message: "Occorreu Um Erro 😔. Talvez já tenha sido emprestado"});
    }
    setTimeout(() => setLoanProces({isLoaning: false, message: "Aguarde"}), 1500);
  };

  return (
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
        {
          loanProcess.isLoaning && <Typography variant="body2">{loanProcess.message}</Typography>
        }
      </CardContent>
      <CardActions>
        <Button size="small" variant="contained" fullWidth onClick={ () => handleLoanBookAction(id) } disabled={ loanProcess.isLoaning }>
          Empréstimo
        </Button>
      </CardActions>
    </Card>
  );
};
