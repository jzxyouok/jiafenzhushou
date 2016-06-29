package com.jiafenzhushou.app.util;

import android.content.Context;
import android.os.Environment;

import org.apache.tools.zip.ZipEntry;
import org.apache.tools.zip.ZipFile;

import java.io.BufferedInputStream;
import java.io.BufferedOutputStream;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.util.Enumeration;
import java.util.zip.ZipException;

/**
 * Created by rocks on 16/4/8.
 */
public class FileUtil {

    public static final String EXTERNAL_STORAGE_DIR = Environment.getExternalStorageDirectory().toString();
    public static final String APP_DIR = EXTERNAL_STORAGE_DIR + File.separator + "jiafenzhushou";
    public static final String DATA_DIR = APP_DIR + File.separator + "data";
    public static final String PHONE_TXT = APP_DIR + File.separator + "phone.txt";
    public static final String ZIP_FILE = "num.zip";

    public static void moveUnzip(Context context, String sourName, String destPath, String destName) {

    }

    /**
     * 文件复制
     *
     * @param context
     * @param sourceName
     * @param destPath
     */
    public static void copy(Context context, String sourceName, String destPath, String destName) throws IOException {

        File decompressDirFile = new File(destPath);
        if (!decompressDirFile.exists()) {
            decompressDirFile.mkdirs();
        }
        InputStream myInput;
        OutputStream myOutput = new FileOutputStream(destPath + File.separator + destName);
        myInput = context.getAssets().open(sourceName);
        byte[] buffer = new byte[1024];
        int length = myInput.read(buffer);
        while (length > 0) {
            myOutput.write(buffer, 0, length);
            length = myInput.read(buffer);
        }

        myOutput.flush();
        myInput.close();
        myOutput.close();
    }

    /**
     * 解压文件
     *
     * @param archive
     * @param decompressDir
     * @throws IOException
     * @throws FileNotFoundException
     * @throws ZipException
     */
    public static void unZipFile(String archive, String decompressDir) throws IOException, FileNotFoundException, ZipException {
        BufferedInputStream bi;
        ZipFile zf = new ZipFile(archive, "GBK");
        Enumeration e = zf.getEntries();
        while (e.hasMoreElements()) {
            ZipEntry ze2 = (ZipEntry) e.nextElement();
            String entryName = ze2.getName();
            String path = decompressDir + "/" + entryName;
            if (ze2.isDirectory()) {
                System.out.println("正在创建解压目录 - " + entryName);
                File decompressDirFile = new File(path);
                if (!decompressDirFile.exists()) {
                    decompressDirFile.mkdirs();
                }
            } else {
                System.out.println("正在创建解压文件 - " + entryName);
                String fileDir = path.substring(0, path.lastIndexOf("/"));
                File fileDirFile = new File(fileDir);
                if (!fileDirFile.exists()) {
                    fileDirFile.mkdirs();
                }
                BufferedOutputStream bos = new BufferedOutputStream(new FileOutputStream(decompressDir + "/" + entryName));
                bi = new BufferedInputStream(zf.getInputStream(ze2));
                byte[] readContent = new byte[1024];
                int readCount = bi.read(readContent);
                while (readCount != -1) {
                    bos.write(readContent, 0, readCount);
                    readCount = bi.read(readContent);
                }
                bos.close();
            }
        }
        zf.close();
    }
}
