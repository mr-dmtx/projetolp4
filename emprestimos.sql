PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE Usuario(cd_usuario integer primary key, cd_email text, cd_senha text);
CREATE TABLE Amigo(cd_amigo integer primary key, nm_amigo text, cd_email_amigo text, cd_telefone text, fk_Usuario_amigo integer, FOREIGN KEY (fk_Usuario_amigo) REFERENCES Usuario(cd_usuario));
CREATE TABLE Emprestimo(cd_emprestimo integer primary key, nm_item text, dt_emprestimo date, dt_devolucao date, fk_Usuario_emprestimo integer, fk_Amigo integer, FOREIGN KEY (fk_Usuario_emprestimo) REFERENCES Usuario(cd_usuario), FOREIGN KEY (fk_Amigo_emprestimo) REFERENCES Amigo(cd_amigo));
COMMIT;
